<form method="post" action="{{ route('products.store') }}">
    @csrf
    <textarea id="description">Hello, World!</textarea>
    <button type="submit">Save Description</button>
</form>