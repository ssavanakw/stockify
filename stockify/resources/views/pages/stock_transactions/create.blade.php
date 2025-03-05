@extends('layouts.main')

@section('content')
<div class="card px-3 py-2 shadow-lg">
    <h2>Add Stock Transaction</h2>

    <form action="{{ route('stock-transactions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Material</label>
            <select name="material_id" id="material_id" class="form-control" required>
                <option value="">Select Material</option>
                @foreach($materials as $material)
                    <option value="{{ $material->id }}" data-price="{{ $material->price }}">
                        {{ $material->name }} - Rp {{ number_format($material->price, 0, ',', '.') }} / unit
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Type</label>
            <select name="transaction_type" class="form-control" required>
                <option value="" disabled {{ old('transaction_type') ? '' : 'selected' }}>Select Type</option>
                <option value="in" {{ old('transaction_type') == 'in' ? 'selected' : '' }}>Stock In</option>
                <option value="out" {{ old('transaction_type') == 'out' ? 'selected' : '' }}>Stock Out</option>
            </select>
        </div>

        <div class="form-group">
            <label>Quantity</label>
            <input type="number" id="quantity" name="quantity" class="form-control" required min="1">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Total Price</label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="text" id="price" name="price" class="form-control" readonly>
            </div>
        </div>

        <div class="form-group">
            <label>Transaction Date</label>
            <input type="date" name="transaction_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Add</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const materialSelect = document.getElementById("material_id");
    const quantityInput = document.getElementById("quantity");
    const priceInput = document.getElementById("price");

    function updatePrice() {
        const selectedMaterial = materialSelect.options[materialSelect.selectedIndex];
        const unitPrice = selectedMaterial.dataset.price ? parseFloat(selectedMaterial.dataset.price) : 0;
        const quantity = parseInt(quantityInput.value) || 1;
        const totalPrice = unitPrice * quantity;
        priceInput.value = new Intl.NumberFormat('id-ID').format(totalPrice);
    }

    materialSelect.addEventListener("change", updatePrice);
    quantityInput.addEventListener("input", updatePrice);
});
</script>
@endsection
