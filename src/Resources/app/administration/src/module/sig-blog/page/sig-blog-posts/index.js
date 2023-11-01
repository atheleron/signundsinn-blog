import template from './sig-blog-posts.html.twig';

const Criteria = Shopware.Data.Criteria;

Shopware.Component.register('sig-blog-posts', {
    template,

    inject: ['repositoryFactory'],

    metaInfo() {
        return {
            title: this.$createTitle()
        };
    },

    data:() => {
        return {
            blog: undefined,
        }
    },

    created() {
      this.getBlogPosts();
    },

    computed: {

      blogRepository() {
        return this.repositoryFactory.create('sig_blog_posts');
      },

      blogCriteria() {
        return new Criteria()
            .addAssociation('author')
      },

      columns() {
        return [
          {
            property: 'title',
            dataIndex: 'title',
            label: 'Title',
            routerLink: 'sig.blog.detail',
            primary: true
          },
          {
            property: 'author',
            dataIndex: 'author',
            label: 'Author',
          },
          {
            property: 'status',
            dataIndex: 'status',
            label: 'Published',
            inlineEdit: 'boolean'
          },
          {
            property: 'publishedAt',
            dataIndex: 'publishedAt',
            label: 'Publish Date',
          },
          {
            property: 'createdAt',
            dataIndex: 'createdAt',
            label: 'Created Date',
          },
          {
            property: 'updatedAt',
            dataIndex: 'updatedAt',
            label: 'Last Update Date',
          }
        ]
      },
    },

    methods: {
      getBlogPosts() {
        return this.blogRepository.search(this.blogCriteria, Shopware.Context.api)
              .then((result) => {
                this.blog = result;
              });
      }
    }

  });