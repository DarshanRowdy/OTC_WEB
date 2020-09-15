export default function auth({ next, router }) {
    let userObj = JSON.parse(localStorage.getItem('userObj'));
    if(userObj && userObj.auth_token){
        return next();
    } else {
        return next('/login');
    }
}
