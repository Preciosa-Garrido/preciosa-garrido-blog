$(function(){
    $('#search-link').click('slow', function(){
        $('.nav-item').toggleClass('hidden')
        $('.resultados').show()
        $('#search-link').hide()
        $('#search-close').show()
        $('.search-area input').show().focus()
    })

    $('#search-close').click('slow', function(){
        $('.nav-item').removeClass('hidden')
        $('.resultados').hide()
        $('#search-close').hide()
        $('#search-link').show()
        $('.search-area input').hide()
    })
});

$(function(){
    $('.addWishlist').submit(function(){
        $.ajax({
            url: '/wishlist/store',
            method: 'POST',
            data: $(this).serialize(),
            success: function(result) {
                swal(result.title, result.message, result.type)
            }
        })

        return false
    })

    $('#commentForm').submit(function(){
        $.ajax({
            url: '/comment',
            method: "POST",
            data: $(this).serialize(),
            success: function(result) {
                swal(result[0], result[1], result[2])
            }
        })

        return false
    })

    function Review() {    
        $('#reviewForm').submit(function(){
            $.ajax({
                url: '/review',
                method: "POST",
                data: $(this).serialize(),
                success: function(result) {
                    swal(result[0], result[1], result[2])
                }
            })

            return false
        })
    }

    $('#contactForm').submit(function(){
        $.ajax({
            url: '/contacts/store',
            method: 'post',
            data: $(this).serialize(),
            success: function(result){
                swal(result[0], result[1], result[2])
                $('input, textarea').val('')
            }
        })
        
        return false;
    })

    $('#newsletterForm').submit(function(){
        $.ajax({
            url: '/newsletter',
            method: 'post',
            data: $(this).serialize(),
            success: function(result) {
                swal(result.title, result.message, result.type)
                $('#newsletterForm input').val('')
            }
        })

        return false
    })
})


$('.avaliacao').click(function(){
    var avaliacao = $(this).attr('data-avaliacao')
    
    $('.review_box ul.avalia')
        .removeClass('star1')
        .removeClass('star2')
        .removeClass('star3')
        .removeClass('star4')
        .removeClass('star5')
        .toggleClass('star'+avaliacao)
});


function storeCart(product) {

    var cart = []

    var qtd = 1

    if ($('#quantidade').val()) {
        qtd = $('#quantidade').val()
    }
    
    var produtos = {
        'product_id': product.id,
        'product': product.product,
        'price': product.price,
        'stock': product.stock,
        'barcode': product.barcode,
        'image': product.image,
        'description': product.description,
        'qtd': qtd * 1
    }

    if(!localStorage.getItem('cart')) {
        cart.push(produtos)

        if(!localStorage.setItem('cart', JSON.stringify(cart)))
            swal('Sucesso', 'Produto adicionado ao carrinho com sucesso', 'success')
        else
            swal('Erro', 'Produto não adicionado ao carrinho', 'error')

        console.log(JSON.parse(localStorage.getItem('cart')))
    } else {
        var vector = []
        var finded = null
        var carrinho = JSON.parse(localStorage.getItem('cart'))

        localStorage.setItem('cart', [])

        carrinho.forEach(key => {
            if(key.product == produtos.product){
                key.qtd = (key.qtd * 1) + produtos.qtd
                finded = true  
            }

            vector.push(key)
        })

        if(!finded) vector.push(produtos)

        if(!localStorage.setItem('cart', JSON.stringify(vector)))
            swal('Sucesso', 'Produto adicionado ao carrinho com sucesso', 'success')
        else
            swal('Erro', 'Produto não adicionado ao carrinho', 'error')
                
        console.log(JSON.parse(localStorage.getItem('cart')))
    }
}