import Token from './Token'
import AppStorage from './AppStorage'

class User {

	//login korar somoy token,name localstorage a rakhlam,phone no o rakha jai
     responseAfterLogin(res){
     	const access_token = res.data.access_token
     	const username = res.data.name
     	if (Token.isValid(access_token)) {
     		AppStorage.store(access_token,username)
     	}
     }

     hasToken(){
     	const storedToken = localStorage.getItem('token');
     
     	if (storedToken) {
     		return Token.isValid(storedToken) ? true : false

     	}
     	return false
     }

     loggedIn(){
     	return this.hasToken()
     }

     logout(){
     	AppStorage.clear()
         this.$router.push({ name: '/' })
     }

	 //get user name

     name(){
     	if (this.loggedIn) {
     		return localStorage.getItem('user')
     	}
     }
	//get user id
     id(){
     	if(this.loggedIn()) {
     		const payload = Token.payload(localStorage.getItem('token'))
     		return payload.sub

     	 }

         return false
     }



}

export default User = new User();