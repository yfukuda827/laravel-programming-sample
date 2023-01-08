
<!-- Portfolio item modal popup-->
<div class="portfolio-modal modal fade" id="portfolioModal{{ $product->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="modal-body">
                            <!-- Project details-->
                            <h2 class="text-uppercase">{{ $product->name }}</h2>
                            <p class="item-intro text-muted">{{ $product->subtitle }}</p>
                            <img class="img-fluid d-block mx-auto" src="{{ asset($product->image_file_path) }}" alt="{{ $product->name }} Picture" />
                            <p>{{ $product->description }}</p>
                            <ul class="list-inline">
                                <li>
                                    <strong>価格:</strong>
                                    {{ $product->price }} yen
                                </li>
                                <li>
                                    <strong>カテゴリー:</strong>
                                    {{ $product->product_category->name }}
                                </li>
                            </ul>
                            <a href="/order/{{ $product->id }}" class="btn btn-primary btn-xl text-uppercase" type="button">
                                <i class="fas fa-cart-shopping me-1"></i>
                                Buy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
