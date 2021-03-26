<div v-if="item.links">
    <a v-if="item.links.show" :href="item.links.show">
        <button type="button" class="btn btn-light">
            Visualizar
        </button>
    </a>

    <a v-if="item.links.edit" :href="item.links.edit">
        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar">
            <i class="fa fa-edit"></i>
        </button>
    </a>

    <a v-if="item.links.destroy" @click.prevent="confirmDelete(item.links.destroy)">
        <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Excluir">
            <i class="fa fa-trash"></i>
        </button>
    </a>

    @yield('button-actions')
</div>
