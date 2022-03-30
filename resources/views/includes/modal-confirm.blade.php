<!-- Button trigger modal -->
<button type="button" class="btn btn-small btn-danger" data-toggle="modal" data-target="#myModal-{{ $post->id }}">
    <i class="fa-solid fa-trash"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal-{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Conferma Eliminazione
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                Sei Sicuro di Eliminare: <strong>{{ $post->title }}</strong> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Annulla</button>
                <form action="{{ route('admin.posts.destroy', $post) }}" method="post">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-outline-success">Conferma</button>
                </form>
            </div>
        </div>
    </div>
</div>
