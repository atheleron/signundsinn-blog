import template from './sig-blog-create.html.twig';

const { mapPropertyErrors } = Shopware.Component.getComponentHelper();

Shopware.Component.register('sig-blog-create', {
    template,

    inject: ['repositoryFactory'],

    metaInfo() {
        return {
            title: this.$createTitle()
        };
    },

    data:() => {
        return {
            blog: {},
            blogCard: '',
            blogSidebar: ''
        }
    },

    computed: {
        blogRepository() {
            return this.repositoryFactory.create('sig_blog_posts');
        },

        currentUser() {
            return Shopware.State.get('session').currentUser;
        },

        editMode() {
            return this.$route.name === 'sig.blog.detail';
        },

        btnType() {
            const type = {
                delete: {
                    text: this.$tc('sig-blog.posts.button.delete'),
                    status: 'danger'
                },
                cancel: {
                    text: this.$tc('sig-blog.posts.button.cancel'),
                    status: 'default'
                }
            };

            return this.editMode ? type.delete : type.cancel;
        },

        ...mapPropertyErrors('blog', [
            'title',
            'content',
            'authorId'
        ])

    },

    created() {
        this.blog = this.blogRepository.create(Shopware.Context.api)
    },

    methods: {
        savePost() {
            // probalby there is a better way to fetch current time trought shopware api but im in hurry
            const currentDateTime = new Date(Date.now()).toISOString();

            const post = this.blog;
            // setting a current loggedin user as author of the new post. 
            // maybe in future admin can assign blog post user... 
            // or I should assign current user to default auth user in backend ?
            post.authorId = this.currentUser.id
            // published_at datetime should be nullable but also it should be added once post is not in draft anymore
            post.publishedAt = post.status === true && !post.publishedAt ? currentDateTime : post.publishedAt

            this.blogRepository
                .save(post, Shopware.Context.api)
                .then(() => {
                    if (post.id) {
                        this.$router.push({name: 'sig.blog.detail', params: {id: post.id}});
                    }
                })
        },

        cancelPost() {

            if(this.editMode) {
                this.blogRepository.delete(this.blog.id, Shopware.Context.api);
            }

            this.$router.push({name: 'sig.blog.posts'});
        },

    }
 
  });