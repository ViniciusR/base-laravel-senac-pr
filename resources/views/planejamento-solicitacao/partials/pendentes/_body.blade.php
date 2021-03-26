<td class="text-left" style="font-size: 14px;">@{{ item.id }}</td>
<td class="text-left" style="font-size: 14px;">@{{ item.Nome }}</td>
<td class="text-left" style="font-size: 14px;">@{{ item.OrigemNome }}</td>
<td class="text-left" style="font-size: 14px;">@{{ item.RotuloNome }}</td>
<td class="text-left" style="font-size: 14px;">@{{ item.ProjetoNome }}</td>
<td class="text-left" style="font-size: 14px;">@{{ item.ClassificacaoNome }}</td>
<td class="text-left">
    <input 
        type="number" 
        class="form-control form-control-sm"
        :value="item.Prioridade"
        min="1"
        @input="handleRowDataChange($event, item.CodSol, 'Prioridade')"/>
    
</td>
<td class="text-left">@{{ item.EquipeNome }}</td>
