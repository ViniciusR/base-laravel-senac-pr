<template>
    <input v-model="value" class="form-control" :placeholder="placeholder">
</template>

<script>
import _ from 'lodash';
import filter from './FilterMixin'

export default {
    name: 'filter-text',

    mixins: [filter],

    watch: {
      value: _.debounce(function (val) {
        this.submit(val);
      }, 500),
    },

    data: () => {
        return {
            value: undefined,
        }
    },
}
</script>
