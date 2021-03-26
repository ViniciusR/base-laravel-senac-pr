<div v-if="item.links">
    <a v-if="item.links.show" :href="item.links.show">
        <button type="button" class="btn btn-light">
            Visualizar
        </button>
    </a>

    <a  v-if="item.links.updateStatusAtendido"
        @click.prevent="confirmAction(item.links.updateStatusAtendido, 'Deseja realmente marcar a solicitação como atendida?',  'Confirmação')">
        <button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="bottom" title="Marcar como atendido">
            <i class="fa fa-check fa-xs"></i>
        </button>
    </a>

    <a  v-if="item.links.updateStatusCancelado"
        @click.prevent="confirmAction(item.links.updateStatusCancelado, 'Deseja realmente marcar a solicitação como cancelada?',  'Confirmação')">
        <button type="button" class="btn btn-sm btn-secondary" data-toggle="tooltip" data-placement="bottom" title="Marcar como cancelada">
            <i class="fa fa-times fa-xs"></i>
        </button>
    </a>

    <a  v-if="item.links.updateStatusPendente"
        @click.prevent="confirmAction(item.links.updateStatusPendente, 'Deseja realmente marcar a solicitação como pendente?',  'Confirmação')">
        <button type="button" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="bottom" title="Marcar como pendente">
            <i class="fa fa-clock-o"></i>
        </button>
    </a>

    <a v-if="item.links.edit" :href="item.links.edit">
        <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" data-placement="bottom" title="Editar">
            <i class="fa fa-edit fa-xs"></i>
        </button>
    </a>

    <a v-if="item.links.destroy" @click.prevent="confirmDelete(item.links.destroy)">
        <button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Excluir">
            <i class="fa fa-trash fa-xs"></i>
        </button>
    </a>
    
    @yield('button-actions')
</div>
