const Criteria = Shopware.Data.Criteria;

Shopware.Component.extend('sig-blog-detail', 'sig-blog-create', {

    metaInfo() {
        return {
            title: 'edit'
        };
    },

    data:() => {
        return {
            blogId: null,
            blog: {},
            blogCard: '',
            blogSidebar: ''
        }
    },

    computed: {
        blogRepository() {
            return this.repositoryFactory.create('sig_blog_posts');
        },

        blogCriteria() {
            return new Criteria()
                .addAssociation('author')
        },
    },

    created() {
        this.repository = this.repositoryFactory.create('sig_blog_posts')

        this.blogId = this.$route.params.id;

        this.repository
            .get(this.blogId, Shopware.Context.api, this.blogCriteria)
            .then(entity => {
                this.blog = entity;
            });
    },

    methods: {
        savePost() {
            this.blogRepository
                .save(this.blog, Shopware.Context.api)
                .then(() => {
                    this.blogRepository
                        .get(this.blogId, Shopware.Context.api, this.blogCriteria)
                        .then(entity => {
                            this.blog = entity;
                        });
                })
        }
    }
    
  });