<template>
  <section>
    <div class="container">
      <br>
      <h1 class="title">Products</h1>

      <div class="columns is-multiline">
        <div class="column is-3" v-for="product in products" :key="product.slug">
          <ProductCard :product="product" />
        </div>
      </div>
    </div>
  </section>
</template>

<script>
  import ProductCard from '@/components/products/ProductCard'
  export default {
    data() {
      return {
        products: [],
      }
    },
    components: {
      ProductCard,
    },
    async asyncData({
      params,
      app
    }) {
      let response = await app.$axios.$get(`products?category=${params.slug}`)

      return {
        products: response.payload,
      }
    },
  }
</script>
