<template>
    <div class="container">
        <div class="section">
            <div class="container is-fluid">
                <div class="columns">
                    <div class="column is-half">
                        <img src="http://via.placeholder.com/620x620" alt="Product name">
                    </div>
                    <div class="column is-half">
                        <section class="section">
                            <h1 class="title is-4">
                                {{ product.name }}
                            </h1>
                            <p>
                                {{ product.description }}
                            </p>

                            <hr>

                            <span class="tag is-rounded is-medium is-dark" v-if="!product.in_stock">
                                 Out Of Stock
                            </span>

                            <span class="tag is-rounded is-medium">
                                {{ product.price }}
                            </span>
                        </section>

                        <section class="section">
                            <ProductVariation 
                                v-for="(variations, type) in product.variations" 
                                :key="type" 
                                :type="type" 
                                :variations="variations"
                                v-model="form.variation"
                            />

                            <div class="field has-addons" v-if="form.variation">
                                <div class="control">
                                    <div class="is-fullwidth">
                                        <input class="input" type="number" v-model="form.quantity">
                                        <p class="help-text">Max: {{ form.variation.stock_count }}</p>
                                    </div>
                                </div>
                                <div class="control">
                                    <button type="button" class="button is-info">
                                        Add To Cart
                                    </button>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ProductVariation from '@/components/products/ProductVariation'
    
    export default {
        data () {
            return {
                product: {},
                form: {
                    variation: '',
                    quantity: 1,
                },
            }
        },
        watch: {
            'form.variation' () {
                this.form.quantity = 1
            },
            'form.quantity' () {
               if (!this.form.variation) {
                    this.form.quantity = 1
                    return
                }

                if (!this.form.variation.in_stock) {
                    this.form.quantity = 1
                    return
                }

                if (this.form.quantity > this.form.variation.stock_count) {
                    this.form.quantity = this.form.variation.stock_count
                }
            }
        },
        components: {
            ProductVariation,
        },
        async asyncData({ params, app }) {
            let response = await app.$axios.$get(`products/${params.slug}`)

            return {
                product: response.payload,
            }
        },
    }
</script>
