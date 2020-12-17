class timerHandler{
    constructor(){
        setInterval(this.update,50)
        console.log("timer started")
    }

    update(){
        if(status == 1){
            for(let i = 0 ; i < timerFunction.length ; i++){
                timerFunction[i]();
            }
        }
    }
}