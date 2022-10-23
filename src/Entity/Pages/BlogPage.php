<?php

namespace App\Entity\Pages;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Kunstmaan\ArticleBundle\Entity\AbstractArticlePage;
use Kunstmaan\NodeSearchBundle\Helper\SearchTypeInterface;
use Kunstmaan\PagePartBundle\Helper\HasPageTemplateInterface;
use Kunstmaan\NodeBundle\Entity\HideSidebarInNodeEditInterface;
use App\Form\Pages\BlogPageAdminType;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BlogPageRepository")
 * @ORM\Table(name="app_blog_pages")
 * @ORM\HasLifecycleCallbacks
 */
class BlogPage extends AbstractArticlePage implements HasPageTemplateInterface, SearchTypeInterface, HideSidebarInNodeEditInterface
{
            /**
     * @var \App\Entity\BlogAuthor
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\BlogAuthor")
     * @ORM\JoinColumn(name="blog_author_id", referencedColumnName="id")
     */
    protected $author;
            /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\BlogCategory")
     * @ORM\JoinTable(name="app_blog_category_page_categories",
     *     joinColumns={@ORM\JoinColumn(name="blog_page_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="blog_category_id", referencedColumnName="id")}
     * )
     */
    protected $categories;
            /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\BlogTag")
     * @ORM\JoinTable(name="app_blog_tag_page_tags",
     *     joinColumns={@ORM\JoinColumn(name="blog_page_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="blog_tag_id", referencedColumnName="id")}
     * )
     */
    protected $tags;
    

    public function __construct()
    {
        $this->categories = new ArrayCollection();
$this->tags = new ArrayCollection();

    }

        /**
     * @param \App\Entity\BlogAuthor $author
     * @return $this
     */
     public function setAuthor($author)
     {
         $this->author = $author;

         return $this;
     }

     /**
      * @return \App\Entity\BlogAuthor $author
      */
      public function getAuthor()
      {
          return $this->author;
      }
    /**
     * @param \App\Entity\BlogCategory $category
     * @return $this
     */
    public function setCategories($category)
    {
        $this->categories = $category;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getCategories()
    {
        return $this->categories;
    }
    /**
     * @param \App\Entity\BlogTag $tag
     * @return $this
     */
    public function setTags($tag)
    {
        $this->tags = $tag;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getTags()
    {
        return $this->tags;
    }


    public function getDefaultAdminType(): string
    {
        return BlogPageAdminType::class;
    }

    public function getSearchType(): string
    {
        return 'Blog';
    }

    public function getPagePartAdminConfigurations(): array
    {
        return ['blogmain'];
    }

    public function getPageTemplates(): array
    {
        return ['blogpage'];
    }

    public function getDefaultView(): string
    {
        return 'Pages/BlogPage/view.html.twig';
    }

    /**
     * Before persisting this entity, check the date.
     * When no date is present, fill in current date and time.
     *
     * @ORM\PrePersist
     */
    public function _prePersist()
    {
        // Set date to now when none is set
        if ($this->date == null) {
            $this->setDate(new \DateTime());
        }
    }
}
