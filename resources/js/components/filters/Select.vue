<template>
    <v-select v-model="value" :options="options" :placeholder="placeholder" :label="label">
      <div slot="no-options">Nenhuma opção disponível</div>
    </v-select>
</template>

<script>
import _ from 'lodash';
import filter from './FilterMixin'

export default {
    name: 'filter-select',

    mixins: [filter],

    props: {
        options: {
            required: true,
            type: Array,
        },
        label: {
            required: false,
            type: String,
        },
    },

    watch: {
      value: _.debounce(function (val) {
        if (val && val.id) {
            this.submit(val.id);
        } else {
            this.submit(null);
        }
      }, 500),
    },

    data: () => {
        return {
            value: undefined,
        }
    },
}
</script>