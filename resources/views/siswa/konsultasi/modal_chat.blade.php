<div class="modal fade" id="chatGuru-{{ $guru->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Chat Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('chat.whatsapp', $guru->id) }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="pesan" class="form-label">Pesan</label>
                            <textarea name="pesan" id="pesan" cols="10" rows="5" class="form-control"></textarea>
                            <sup class="text-danger">* Masukan pesan yang akan dikirimkan ke guru</sup>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-success"><i
                            class="menu-icon tf-icons bx bx-message-square-dots"></i> Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>