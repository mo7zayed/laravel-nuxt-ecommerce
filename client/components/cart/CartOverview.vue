<template>
  <div>
    <div class="table-container">
      <table class="table is-hoverable is-fullwidth">
        <tbody>
          <CartOverviewProduct v-for="product in products" :key="product.id" :product="product" />
          <tr>
            <td></td>
            <td></td>
            <td>
              <p class="has-text-weight-bold">
                Subtotal
              </p>
            </td>
            <td>
              {{ subtotal }}
            </td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
  import {
    mapGetters
  } from 'vuex'
  import CartOverviewProduct from '@/components/cart/CartOverviewProduct'

  export default {
    components: {
      CartOverviewProduct
    },
    computed: {
      ...mapGetters({
        products: 'cart/products',
        subtotal: 'cart/subtotal',
        changed: 'cart/changed',
      })
    }
  }
</script>
