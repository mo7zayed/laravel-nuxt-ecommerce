<template>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <nuxt-link to="/" class="navbar-item">
                <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </nuxt-link>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <nuxt-link to="/" class="navbar-item">
                    Home
                </nuxt-link>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <nuxt-link to="/auth/register" class="button is-primary">
                            <strong>Sign up</strong>
                        </nuxt-link>
                        <nuxt-link to="/auth/login" class="button is-light">
                            <strong>Login</strong>
                        </nuxt-link>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {

    }
</script>
