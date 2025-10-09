<div
    class="modal fade"
    id="al-warning-alert"
    tabindex="-1"
    aria-labelledby="vertical-center-modal"
    aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div
            class="modal-content modal-filled">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center text-danger">
                    <p class="mt-3">
                        You won&apos;t retrieve this item after deletion. Are you sure you want to delete this item?
                    </p>
                    <div class="d-flex gap-6 justify-content-center my-2">
                        <form method="POST" id="deleteForm">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="item_id" id="item_id">
                        </form>
                        <button
                            type="button"
                            onclick="(e)=> e.preventDefault();document.getElementById('deleteForm').submit()"
                            class="btn btn-danger"
                            data-bs-dismiss="modal">
                            Confirm
                        </button>
                        <button
                            type="button"
                            class="btn btn-outline-danger"
                            data-bs-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>

<script>
    const deleteModalForm = (actionUrl, itemId) => {
        const form = $('#deleteForm');
        form.attr('action', actionUrl);

        $('#item_id').val(itemId);
    }
</script>