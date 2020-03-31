<template>
    <section class="hero">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-4-tablet is-4-desktop is-4-widescreen">
                        <h1 class="title has-text-gray">Login</h1>

                        <div class="notification is-danger" v-if="errors.length">
                            <ul>
                                <li v-for="e in errors">{{ e }}</li>
                            </ul>
                        </div>


                        <div class="box">
                            <form @submit.prevent="submit()">
                                <div class="field">
                                    <div class="control">
                                        <label for="email" class="label">Email</label>
                                        <input type="email" v-model="form.email" placeholder="e.g. bobsmith@gmail.com" class="input" autofocus>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <label for="password" class="label">Password</label>
                                        <input type="password" v-model="form.password" placeholder="*******" class="input">
                                    </div>
                                </div>
                                <div class="field">
                                    <label for="" class="checkbox">
                                        <input type="checkbox">
                                        Remember me
                                    </label>
                                </div>
                                <div class="field">
                                    <button class="button is-success">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                form: {
                    email: 'mohamed.zayed@app.com',
                    password: '123456',
                },
                errors: [],
            }
        },
        methods: {
            async submit() {
                await this.$auth.login({ data: this.form }).catch((error) => {
                    var messages = error.response.data;

                    this.errors = []

                    this.errors.push(messages.message);

                    for (var key in messages.errors) {
                        if (Array.isArray(messages.errors[key])) {
                            for (var i = 0; i < messages.errors[key].length; i++) {
                                this.errors.push(messages.errors[key][i]);
                            }
                        } else {
                            this.errors.push(messages.errors[key]);
                        }
                    }
                });
            },
        },
    }
</script>
