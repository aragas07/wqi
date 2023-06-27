class Htall extends Map{
    crud(d){
        var output = ""
        $(".loading-section").css('display','flex')
        $.ajax({
            url: d.url,
            type: 'post',
            data: d.data,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success: function(result){
                $(".loading-section").css('display','none')
                output = result
            },
            error: function (request, status, error) {
                output = request.responseText
            }
        })
        return output
    }

    getData(d){
        var output = ""
        $.ajax({
            url: d.url,
            type: 'post',
            data: d.data,
            async: false,
            dataType: 'JSON',
            success: function(result){
                output = result
            },
            error: function (request, status, error) {
                console.log(request.responseText)
                output = request.responseText
            }
        })
        return output
    }
    
    swal(d){
        Swal.fire({
            icon: d.icon,
            text: d.msg,
            title: d.title
        })
    }

    location(d){
        sessionStorage.setItem("auth",d.auth)
        sessionStorage.setItem("data",JSON.stringify(d.data))
        window.location.href = d.href
    }

    include(main){
        const extend = $("#extend").html()
        $("#extend").empty()
        $.get(`template/${main}`,function(e){
            $("#component").html(e)
            $("#include").html(extend)
        })
    }

    toast(){
        return Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });
    }

    url(){
        var url = window.location.pathname.split("/")
        return url[1]
    }
    user(){
        var data = JSON.parse(sessionStorage.getItem("data"))
        return data
    }
}

const htall = new Htall()