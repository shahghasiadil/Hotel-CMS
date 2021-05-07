export default class Gates{

    constructor(user){
        this.user = user;
    }
    isAdmin(){
        return this.user.type === 'admin'
    }
}