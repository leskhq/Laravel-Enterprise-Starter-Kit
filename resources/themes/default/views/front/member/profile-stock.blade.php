<div class="panel panel-default">
    {!! Form::open(['route' => 'store.update-stock', 'method' => 'POST']) !!}
    {!! Form::hidden('store_partner_id', $user->partner->storePartner->id) !!}
    <div class="panel-body">
        <h3 class="header-title">Heading</h3><hr>
        @foreach($user->partner->storePartner->storePartnerProducts as $value)
            <div class="col-md-4 col-sm-4">
              <article class="aa-latest-blog-single">
                <figure class="aa-blog-img">                    
                  <a href="#"><img alt="img" src="https://i.imgsafe.org/82f036f033.jpg"></a>  
                    <figcaption class="aa-blog-img-caption">
                    <span href="#"><i class="fa fa-eye"></i>5K</span>
                    <a href="#"><i class="fa fa-thumbs-o-up"></i>{{ $value->ranking }}/5</a>
                    <a href="#"><i class="fa fa-comment-o"></i>20</a>
                    <span href="#"><i class="fa fa-clock-o"></i>June 26, 2016</span>
                  </figcaption>                          
                </figure>
                <div class="aa-blog-info">
                  <h3 class="aa-blog-title"><a href="#">{{ $value->product->name }}</a></h3>
                  <p>Stok<br>{!! Form::text('stock['.$value->product_id.']', $value->stock, ['class' => 'form-control']) !!}</p>
                </div>
              </article>
            </div>
        @endforeach
    </div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-primary">update stocks</button>
    </div>
    {!! Form::close() !!}
</div>