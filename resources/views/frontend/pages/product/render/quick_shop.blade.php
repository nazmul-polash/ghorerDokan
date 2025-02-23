<div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    <form method="post" action="#" id="product-form-quickshop" class="product-form align-items-center">
       <!-- Product Info -->
       <div class="row g-0 item mb-3">
          <a class="col-4 product-image" href="product-layout1.html">
                <img class="blur-up lazyload"  src="{{ asset('uploads/product/'.$product->thumbnail) }}" alt="Product" title="Product" width="625" height="800" />
             </a>
          <div class="col-8 product-details">
                <div class="product-variant ps-3">
                   <a class="product-title" href="product-layout1.html">{{ $product->product_name }}</a>
                   <div class="priceRow mt-2 mb-3">
                      <div class="product-price m-0">
                        <span class="old-price">{{ '$' . number_format($product->purchase_price, 2) }}</span>
                        <span class="price">{{ '$' . number_format($product->selling_price, 2) }}</span>
                     </div>
                   </div>
                   <div class="qtyField">
                      <a class="qtyBtn minus" href="#;"><i class="icon anm anm-minus-r"></i></a>
                      <input type="text" name="quantity" value="1" class="qty">
                      <a class="qtyBtn plus" href="#;"><i class="icon anm anm-plus-r"></i></a>
                   </div> 
                </div>
          </div>
       </div>
       <!-- End Product Info -->
       <!-- Swatches Color -->
       <div class="variants-clr swatches-image clearfix mb-3 swatch-0 option1" data-option-index="0">
          <label class="label d-flex justify-content-center">Color:<span class="slVariant ms-1 fw-bold">Black</span></label>
          <ul class="swatches d-flex-justify-center pt-1 clearfix">
                <li class="swatch large radius available active"><img src="{{ asset('frontend') }}/assets/images/products/swatches/blue-red.jpg" alt="image" width="70" height="70" data-bs-toggle="tooltip" data-bs-placement="top" title="Blue" /></li>
                <li class="swatch large radius available"><img src="{{ asset('frontend') }}/assets/images/products/swatches/blue-red.jpg" alt="image" width="70" height="70" data-bs-toggle="tooltip" data-bs-placement="top" title="Black" /></li>
                <li class="swatch large radius available"><img src="{{ asset('frontend') }}/assets/images/products/swatches/blue-red.jpg" alt="image" width="70" height="70" data-bs-toggle="tooltip" data-bs-placement="top" title="Pink" /></li>
                <li class="swatch large radius available green"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Green"></span></li>
                <li class="swatch large radius soldout yellow"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="Yellow"></span></li>
          </ul>
       </div>
       <!-- End Swatches Color -->
       <!-- Swatches Size -->
       <div class="variants-size swatches-size clearfix mb-4 swatch-1 option2" data-option-index="1">
          <label class="label d-flex justify-content-center">Size:<span class="slVariant ms-1 fw-bold">S</span></label>
          <ul class="size-swatches d-flex-justify-center pt-1 clearfix">
                <li class="swatch large radius soldout"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="XS">XS</span></li>
                <li class="swatch large radius available active"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="S">S</span></li>
                <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="M">M</span></li>
                <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="L">L</span></li>
                <li class="swatch large radius available"><span class="swatchLbl" data-bs-toggle="tooltip" data-bs-placement="top" title="XL">XL</span></li>
          </ul>
       </div>
       <!-- End Swatches Size -->
       <!-- Product Action -->
       <div class="product-form-submit d-flex-justify-center">
          <button type="submit" name="add" class="btn product-cart-submit me-2"><span>Add to cart</span></button>
          <button type="submit" name="sold" class="btn btn-secondary product-sold-out d-none" disabled="disabled">Sold out</button>
          <button type="submit" name="buy" class="btn btn-secondary proceed-to-checkout">Buy it now</button>
       </div>
       <!-- End Product Action -->
        <div class="text-center mt-3"><a class="text-link" href="{{ route('product.details',['id'=>$product->id]) }}">View More Details</a></div>
    </form>
</div>