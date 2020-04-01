<template>
    <nav class="navbar is-dark">
        <div class="container">
            <div class="navbar-brand">
                <nuxt-link to="/" class="navbar-item">
                    Ecommerce
                </nuxt-link>
                <div class="navbar-burger burger" data-target="nav">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

            <div class="navbar-start">
                <template v-for="category in categories">
                    <template v-if="category.children.length">
                        <div class="navbar-item has-dropdown is-hoverable" :key="category.slug">
                            <nuxt-link :to="{ name: 'categories-slug', params: { slug: category.slug } }" class="navbar-link">
                                {{ category.name }}
                            </nuxt-link>

                            <div class="navbar-dropdown">
                                <template v-for="c in category.children">
                                    <nuxt-link :key="c.slug" :to="{ name: 'categories-slug', params: { slug: c.slug } }" class="navbar-item">
                                        {{ c.name }}
                                    </nuxt-link>
                                </template>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <nuxt-link :key="category.slug" :to="{ name: 'categories-slug', params: { slug: category.slug } }" class="navbar-item">
                            {{ category.name }}
                        </nuxt-link>
                    </template>
                </template>
            </div>

            <div id="nav" class="navbar-menu">
                <div class="navbar-end">
                    <nuxt-link to="/login" class="navbar-item">
                        Login
                    </nuxt-link>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    import { mapGetters } from 'vuex'

    export default {
        computed: {
            ...mapGetters({
                categories: 'categories',
            }),
        },
    }
</script>
