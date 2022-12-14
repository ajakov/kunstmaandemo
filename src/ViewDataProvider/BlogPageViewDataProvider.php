<?php

declare(strict_types=1);

namespace App\ViewDataProvider;

use App\Entity\Pages\BlogPage;
use Doctrine\ORM\EntityManagerInterface;
use Kunstmaan\NodeBundle\Entity\NodeTranslation;
use Kunstmaan\NodeBundle\Entity\PageViewDataProviderInterface;
use Kunstmaan\NodeBundle\Helper\RenderContext;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Exception\OutOfRangeCurrentPageException;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class BlogPageViewDataProvider implements PageViewDataProviderInterface
{
    /** @var RequestStack */
    private $requestStack;
    /** @var EntityManagerInterface */
    private $em;
    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em, UrlGeneratorInterface $urlGenerator)
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
        $this->urlGenerator = $urlGenerator;
    }

    public function provideViewData(NodeTranslation $nodeTranslation, RenderContext $renderContext): void
    {
        $request = $this->requestStack->getMainRequest();
        
        if (null === $request) {
            return;
        }

        $searchCategory = $request->get('category') ? explode(',', $request->get('category')) : null;
        $searchTag = $request->get('tag') ? explode(',', $request->get('tag')) : null;

        $pageRepository = $this->em->getRepository(BlogPage::class);
        $result = $pageRepository->getArticles($request->getLocale(), null, null, $searchCategory, $searchTag);

        // Filter the results for this page
        $adapter = new ArrayAdapter($result);
        $pagerfanta = new Pagerfanta($adapter);
        $pagerfanta->setMaxPerPage(10);
        $pagenumber = $request->query->getInt('page', 1);
        $pagenumber = $pagenumber < 1 ? 1 : $pagenumber;

        try {
            $pagerfanta->setCurrentPage($pagenumber);
        } catch (OutOfRangeCurrentPageException $oore) {
            $repo = $this->em->getRepository(NodeTranslation::class);
            $nt = $repo->getNodeTranslationByLanguageAndInternalName($request->getLocale(), 'blog');
            $url = $this->urlGenerator->generate('_slug', array('url' => $nt ? $nt->getUrl() : '', '_locale' => $request->getLocale()));

            $renderContext->setResponse(new RedirectResponse($url));

            return;
        }

        $results = $pagerfanta->getCurrentPageResults();

        $renderContext['results'] = $results;
        $renderContext['pagerfanta'] = $pagerfanta;
        $renderContext['nodeTranslation'] = $nodeTranslation;
    }
}
