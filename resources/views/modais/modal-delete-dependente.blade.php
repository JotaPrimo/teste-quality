<!-- Modal -->
<div class="modal fade" id="modal-deletar-dependente{{ $dependente->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deletando dependente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               Deletar este dependente {{ $dependente->nome }} ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                <form action="{{ route('cadastros.remover-dependente') }}" method="post">
                    @csrf
                    <input type="hidden" name="cadastro_id" value="{{ $cadastro->id }}">
                    <input type="hidden" name="dependente_id" value="{{ $dependente->id }}">

                    <button type="submit" class="btn btn-danger" id="">Deletar</button>
                </form>

            </div>

        </div>

    </div>

</div>
