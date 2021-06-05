class Token{

	isValid(token){
		//login user token catch using payload
		const payload = this.payload(token);
		//check payload issue date is come from login or register url
		if (payload) {
			return payload.iss == "http://localhost:8000/api/auth/login" || "http://localhost:8000/api/auth/register" ? true : false
		}

		return false
	}

	payload(token){
		const payload =	token.split('.')[1]
	    return this.decode(payload)
	}

	decode(payload){
		return JSON.parse(atob(payload))
	}

}

export default Token = new Token()