<h2>{{ $article->titre }}</h2>
<p>{{ Str::limit($article->contenu, 100) }}... </p>

<button id="payButton">Lire la suite</button>

<script src="https://cdn.fedapay.com/checkout.js"></script>
<script>
document.getElementById('payButton').addEventListener('click', function() {
    FedaPay.init({
        public_key: "{{ env('FEDAPAY_PUBLIC_KEY') }}",
        transaction: {!! $transaction !!}
    });
    FedaPay.open();
});
</script>
