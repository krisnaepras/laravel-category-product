<div class="modal fade" id="productModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="#" id="productForm">
                    <input type="hidden" name="id" id="id">
                    <div class="mb3">
                        <label for="name">Nama</label>
                        <input type="text" name="name" class="form-control" id="name">
                        <label for="description">Description</label>
                        <input type="text" name="description" class="form-control" id="description">
                        <label for="price">Price</label>
                        <input type="text" name="price" class="form-control" id="price">
                    </div>

                    <div class="float-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btnSubmit"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
