import './page/sig-blog-posts'
import './page/sig-blog-create'
import './page/sig-blog-detail'
import enGB from './snippet/en-GB.json';

Shopware.Module.register('sig-blog', {
    type: 'plugin',
    name: 'Blog',
    title: 'sig-blog.general.mainMenuItemGeneral',
    description: 'sig-blog.general.descriptionTextModule',
    color: '#ff3d58',
    icon: 'default-shopping-paper-bag-product',

    snippets: {
        'en-GB': enGB
    },

    routes: {
        posts: {
            component: 'sig-blog-posts',
            path: 'posts'
        },
        create: {
            component: 'sig-blog-create',
            path: 'create'
        },
        detail: {
            component: 'sig-blog-detail',
            path: 'detail/:id'
        }
    },

    navigation: [{
        label: 'sig-blog.general.mainMenuItemGeneral',
        color: '#ff3d58',
        path: 'sig.blog.posts',
        icon: 'default-shopping-paper-bag-product',
        parent: 'sw-catalogue',
        position: 100
    }]
})