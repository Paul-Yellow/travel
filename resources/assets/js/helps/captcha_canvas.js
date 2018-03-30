class CaptchaCanvas
{
    constructor()
    {
        this.canvas = document.querySelector('#canvas');
        this.ctx = this.canvas.getContext('2d');
        this.strArray = []
    }
    getColors()
    {
        let [r,g,b,a]=[Math.floor(Math.random()*255),Math.floor(Math.random()*255),Math.floor(Math.random()*255),Math.random().toFixed(1)];
        return [r,g,b,a];
    }
    getText()
    {
        let strArr = [];
        for(let i=65;i<91;i++){//大写字母
            strArr.push(String.fromCharCode(i));
        }
        for(let i=97;i<123;i++){//小写字母
            strArr.push(String.fromCharCode(i));
        }
        for(let i=0;i<=9;i++){//数字
            strArr.push(i);
        }
        let strArrLength=strArr.length;
        return strArr[Math.floor(Math.random()*strArrLength)];
    }
    graphicVerification()
    {
         let graphicWidth=this.canvas.width,
            graphicHeight=this.canvas.height,
            [r,g,b,a]=this.getColors();
            this.ctx.clearRect(0,0,graphicWidth,graphicHeight);
            this.ctx.fillStyle="rgba("+r+","+g+","+b+","+a+")";
            this.ctx.fillRect(0,0,graphicWidth,graphicHeight);//背景矩形
            for(let i=0;i<=50;i++){//增加圆
                let [red,green,blue]=[Math.floor(Math.random()*255),Math.floor(Math.random()*255),Math.floor(Math.random()*255)];
                this.ctx.beginPath();
                this.ctx.arc(Math.floor(Math.random()*graphicWidth),Math.floor(Math.random()*graphicHeight),2,0,2*Math.PI);
                this.ctx.fillStyle="rgb("+red+","+green+","+blue+")";
                this.ctx.closePath();
                this.ctx.fill();
                this.ctx.closePath();
            }
            //文字填充;
                this.ctx.font="40px Georgia";
                this.ctx.fillStyle="rgb("+this.getColors()[0]+","+this.getColors()[1]+","+this.getColors()[2]+")";
                this.strArray[0]=this.getText();
                this.ctx.fillText(this.strArray[0],10,35);
                this.ctx.fillStyle="rgb("+this.getColors()[0]+","+this.getColors()[1]+","+this.getColors()[2]+")";
                this.strArray[1]=this.getText();
                this.ctx.fillText(this.strArray[1],65,35);
                this.ctx.fillStyle="rgb("+this.getColors()[0]+","+this.getColors()[1]+","+this.getColors()[2]+")";
                this.strArray[2]=this.getText();
                this.ctx.fillText(this.strArray[2],120,35);
                this.ctx.fillStyle="rgb("+this.getColors()[0]+","+this.getColors()[1]+","+this.getColors()[2]+")";
                this.strArray[3]=this.getText();
                this.ctx.fillText(this.strArray[3],170,35);
    }
}
export default CaptchaCanvas;