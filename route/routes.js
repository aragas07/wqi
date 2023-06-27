export default{
    nav
}
const urlRoutes = {
    404:{template: "template/layout/404.html", title: "Page not found"},
    "/": {template: "template/publishdisplay/home.php", title:"HOME", auth: "none"},
    "/map": {template: "template/publishdisplay/map.php", title:"Map", auth: "none"},
    "/wqi": {template: "template/publishdisplay/wqi.php", title:"WQI", auth: "none"},
    "/login": {template: "template/admin/login.html", title:"WQI", auth: "none"},
    "/data": {template: "template/publishdisplay/data.php", title: "Data", auth:"none"},
    "/dashboard": {template: "template/admin/dashboard.html", title:"Dashboard", auth:"admin"},
    "/station": {template: "template/admin/viewStation.html", title: "Station", auth: "admin"},
    "/parameter": {template: "template/admin/parameter.html", title: "Parameter", auth: "admin"},
    "/wqg": {template: "template/admin/wqg.html", title: "WQG", auth: "admin"},
    "/personnel": {template: "template/admin/personnel.html", title: "Personnel", auth: "admin"},
    "/admindata": {template: "template/admin/data.html", title: "Data", auth: "admin"},
    "/adminwqi": {template: "template/admin/wqi.html", title: "WQI", auth: "admin"}
}

window.addEventListener('click', function(){
    if(sessionStorage.length == 0){
        window.location.href = '/'
    }
})

function nav(){
    document.addEventListener("click",(e)=>{
        const {target} = e;
        if(!target.matches("u")){
            return
        }
        e.preventDefault()
        urlRoute()
    })
}

const urlRoute = (event)=>{
    event = window.event
    event.preventDefault()
    window.history.pushState({}, "",event.target.href)
    urlLocationHandler()
}

// sessionStorage.setItem("auth","none")
if(sessionStorage.length == 0){
    sessionStorage.setItem("auth","none")
}else if(sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer') == 'true'){
    sessionStorage.setItem("auth","none")
    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', 'false')
}
const urlLocationHandler = async()=>{
    const auth = sessionStorage.getItem('auth')
    console.log(auth)
    const location = window.location.pathname
    if(location == '/map' && auth == 'none'){
    }else if(location == '/wqi' && auth == 'none'){
    }else if(location == '/login' && auth == 'none'){
    }else if(location == '/data' && auth == 'none'){
    }else if(auth == 'none' && location.length > 1){
        window.location.href = "/"
    }
    const route = urlRoutes[location] || urlRoutes[404]
    
    $(function(){
        auth == route.auth ?
        $.get(route.template,function(e){
            $("#component").html(e)
        }): $.get("template/layout/404.html",function(e){
            $("#component").html(e)
        })
    })
    document.title = route.title
}

window.onpopstate = urlLocationHandler
window.route = urlRoute
urlLocationHandler()