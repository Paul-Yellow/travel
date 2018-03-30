<template>
  <div>
    <div class="unit-title-blk bg-slash">
      <Breadcrumb class="breadcrumb"></Breadcrumb>
      <h2 class="unit-title icon-unit-play">{{$route.name}}</h2>
    </div>
    <div class="page-content-wrapper member-wrapper">
      <div class="">
        <div class="news-detail-blk snacks-top">
          <div class="page-header mustvisit">
            <div class="header-img img-card frame">
              <span class="thumb-frame">
                <img src="/images/mustv/bichi.jpg" alt="中源必吃" class=" lazyloaded"> 
              </span>
            </div>
            <div class="artical">
              <p class="title">中源必吃</p>
              <p class="text">中源是个族群与民风纯朴的地方，体现最完整的地方就在饮食文化。想想深刻体验中源的特色，就从品尝当地小吃开始吧！</p>
            </div>
          </div>
          <div class="page-list-blk">
            <div class="list-title">最受欢迎的中源美食 Top 10</div>
              <ul class="page-list-card">
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/chaofen.jpg" alt="靖安炒粉" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">1</p>
                    <h3 class="info-title">靖安炒粉</h3>
                    <p class="text">靖安炒粉是中源的国民美食之一，靖安炒粉要好吃，面条、火侯及肉三大元素缺一不可，。从小摊到老店，各门派莫不潜心专研靖安炒粉学，靖安炒粉已成中源之光，各店家花尽心思追求靖安炒粉极致美味！</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card">
                    <span class="thumb-frame">
                      <img src="/images/mustv/aiye.jpg" alt="艾叶饼" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">2</p>
                    <h3 class="info-title">艾叶饼</h3>
                    <p class="text">艾叶粑粑又称蒿子粑粑，是一道传统的小吃，一般在清明节，寒食节食用。因为香蒿叶子很像辟邪的艾叶，也叫艾蒿，故可能有地方叫艾叶粑粑。香蒿草小，气味其实比艾叶清淡很多。清明寒食里面有一种是艾叶粑粑，外表是深绿色的、里面的馅或是豆沙或是碎花生的甜糍粑，也有放碎菜叶做成咸的，入口即闻一股艾叶的清香。食之，可祛风驱邪。大冶地区用的是蒿草做米粑，也坐蒿子</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/tongzhiye.jpg" alt="桐子叶饼" class="thumb lazyloaded">
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">3</p>
                    <h3 class="info-title">桐子叶饼</h3>
                    <p class="text">桐子叶粑粑的原料有粳米、籼米、玉米、小麦等，虽然原料不一，但都需要发酵。发酵的方式不一样，有的用稀饭加干料发，有的则直接发。发酵好后取新鲜老嫩适中的油桐叶包上，包的时候将桐叶尾部卷成一个漏斗状，放入原料后将头部盖上，形状一头尖一头平。最后放在蒸笼里蒸，熟后有种特殊的清香味</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/mihoutao.jpg" alt="糖点心" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">4</p>
                    <h3 class="info-title">猕猴桃糖点心</h3>
                    <p class="text">都是使用野生猕猴桃制作的糖点心是难得的天然食品;</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/youji.jpg" alt="有机蔬菜" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">5</p>
                    <h3 class="info-title">有机蔬菜</h3>
                    <p class="text">在蔬菜生产过程中严格按照有机生产规程，禁止使用任何化学合成的农药、化肥、生长调节剂等化学物质，以及基因工程生物及其产物，而是遵循自然规律和生态学原理，采取一系列可持续发展的农业技术，协调种植平衡，维持农业生态系统持续稳定</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/nangua.jpg" alt="南瓜干，南瓜饼" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">6</p>
                    <h3 class="info-title">南瓜干，南瓜饼</h3>
                    <p class="text">南瓜具有很高的营养价值，每100克南瓜鲜果中含有水分91.997.8克、碳水化合物1.35.7克、胡萝卜素0.572.4毫克，还有其他维生素（VC、VB、VE等）、氨基酸（瓜氨酸、天门冬氨酸等）和矿物质（Fe、P、Zn、Se等）。南瓜还具有一定的药用价值，是幼儿、老人、消化不良、高血压、肾炎等病人的保养食品，不能多食糖类的糖尿病人，唯食用南瓜无妨。因为南瓜中的南瓜子碱、葫芦巴碱、果胶等生理活性物质能催化分解致癌物质亚硝胺，加快肾结石、膀胱结石的溶解、帮助消除人体内多余胆固醇，防止动脉硬化。南瓜还有明目和医治哮喘病的作用，常吃南瓜可防治夜盲症。</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/hongshu.jpg" alt="红薯干" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">7</p>
                    <h3 class="info-title">红薯干</h3>
                    <p class="text">名番薯、甘薯、山芋、地瓜、红苕、线苕、白薯、金薯、甜薯、朱薯、枕薯等。常见的多年生双子叶植物，草本，其蔓细长，茎匍匐地面。块根，无氧呼吸产生乳酸，皮色发白或发红，肉大多为黄白色，但也有紫色，除供食用外，还可以制糖和酿酒、制酒精。</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/qiezi.jpg" alt="茄子干" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">8</p>
                    <h3 class="info-title">茄子干</h3>
                    <p class="text">茄子(Solanum melongena L.)一年生草本植物，热带为多年生灌木,古称酪酥、昆仑瓜,以幼嫩果实供食用,原产东南亚，公元4～5世纪传入中国。直根系，根深50厘米，横向伸展120厘米，大部分布在30厘米耕作层内。茄子主茎上的果实称“门茄”’一级侧枝的果实称为“对茄”，二级侧枝的果实称为“四母斗”，三级侧枝的果实称为“八面风”，以后侧枝的果实称为“满天星”。茄子味甘、性凉，入脾、胃、大肠经。 根据营养专家黎黍匀分析，茄子的预防疾病指数为26.29，生命力指数为9.7142，证明对疾病的康复具有相当高的价值，而对生命力的提高属于有效范围。茄子 - 食疗作用 1、保护心血管、抗坏血酸：茄子含丰富的维生素P，这种物质能增强人体细胞间的粘着力，增强毛细血管的弹性，减低毛细血管的脆性及渗透性，防止微血管破裂出血，使心血管保持正常的功能。此外，茄子还有防治坏血病及促进伤品愈合的功效。2、防治胃癌：茄子含有龙葵碱，能抑制消化系统肿瘤的增殖，对于防治胃癌有一定效果。此外，茄子还有清退癌热的作用。3、抗衰老：茄子含有维生素E，有防止出血和抗衰老功能，常吃茄子，可使血液中胆固醇水平不致增高，对延缓人体衰老具有积极的意义。相关人群 一般人群均可食用。1、可清热解暑，对于容易长痱子、生疮疖的人，尤为适宜；2、但脾胃虚寒、哮喘者不宜多吃。且茄子秋后其味偏苦，性凉，脾胃虚寒、体弱、便溏者不宜多食；手术前吃茄子，麻醉剂可能无法被正常地分解，会拖延病人苏醒时间，影响病人康复速度。靖安的茄子干是要用白糖几渍几晒做成的。</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/zongzi.jpg" alt="粽子" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">9</p>
                    <h3 class="info-title">粽子</h3>
                    <p class="text">粽籺，是籺的一种，俗称“粽子”，又称“角黍”、“筒粽”。粽籺是一种粽叶包裹糯米蒸煮食品，是中华民族传统节庆食物之一。粽早在春秋时期就已出现，最初是用来祭祀祖先和神灵。到了晋代，粽成为了端午节庆食物。粽作为中国历史文化积淀最深厚的传统食品之一，亦传播甚远。日本、越南以及华人聚居的新加坡、马来西亚、缅甸等地也有吃粽的习俗。常见的粽子种类有：“蛤蒌五花肉粽”、“腊肉香肠粽”、“薄荷香粽”、“豆沙粽”、“莲子粽”、“松仁粽”、“蛋黄粽”、“鲜肉粽”、“火腿粽”、“竹叶粽”、“艾香粽”、“甜茶粽”等。</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/huangnianbing.jpg" alt="黄粘饼" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">10</p>
                    <h3 class="info-title">黄粘饼</h3>
                    <p class="text">黄粘饼是用一种叫黄荆叉里烧的碱和用黏性大的米或米粉蒸成的糕。</p>
                  </div>
                </li>
                <li class="item">
                  <div class="img-card frame">
                    <span class="thumb-frame">
                      <img src="/images/mustv/tangpian.jpg" alt="我们方言话是烫片" class="thumb lazyloaded"> 
                    </span>
                  </div>
                  <div class="info-blk">
                    <p class="rankings">11</p>
                    <h3 class="info-title">烫片(我门方言话)</h3>
                    <p class="text">最后压轴的是我们独有的烫片；用沙子炒的，或者油炸的,味道超棒，</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  </div>
</template>
<script>
import Breadcrumb from 'components/layout/breadcrumb';
export default {
  name: 'biyou',
  components:{
    Breadcrumb
  }
}
</script>
<style lang="scss" scoped>
.mustvisit.header-style-1 {
                position: relative;
                text-align: center
            }

            .mustvisit.header-style-1 .artical {
                position: absolute;
                top: 0;
                width: 100%;
                height: 100%;
                display: -webkit-flex;
                display: flex;
                -webkit-flex-flow: row wrap;
                flex-flow: row wrap;
                -webkit-align-items: center;
                align-items: center;
                -webkit-justify-content: center;
                justify-content: center
            }

            .mustvisit.header-style-1 .artical .b-style-1 {
                display: block;
                line-height: 1;
                border: 3px solid #fff;
                padding: 20px 10px;
                margin: 10px
            }

            .mustvisit.header-style-1 .artical .b-style-1 *,.mustvisit.header-style-1 .artical .b-style-1 :after,.mustvisit.header-style-1 .artical .b-style-1 :before {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box
            }

            .mustvisit.header-style-1 .artical .title {
                width: 50%;
                display: inline-block;
                font-size: 1.875em;
                line-height: 1.6em;
                color: #fff;
                transition: all 1s false false
            }

            @media (min-width: 0) and (max-width:767px) {
                .mustvisit.header-style-1 .artical .b-style-1 {
                    padding:10px;
                    margin: 12px
                }

                .mustvisit.header-style-1 .artical .title {
                    width: 60%;
                    font-size: 1.25em;
                    line-height: 1.2em
                }
            }

            @media (min-width: 1200px) {
                .mustvisit.header-style-1 .artical .title {
                    font-size:2.875em;
                    line-height: 1.56522em
                }
            }

            .mustvisit-intro {
                border-top: 6px solid #ffe73d;
                // background: url(/Content/images/content/must-visit/bg-style-1.png) #fff;
                background-size: 12px 12px;
                padding: 3.44828% 6.89655%
            }

            .mustvisit-intro .text {
                color: #000;
                text-align: center;
                max-width: 700px;
                margin: 0 auto .5em
            }

            @media (min-width: 0) and (max-width:767px) {
                .mustvisit-intro .text {
                    font-size:1em;
                    line-height: 1.8em
                }
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .mustvisit-intro .text {
                    font-size:1.125em;
                    line-height: 1.6em
                }
            }

            @media (min-width: 1200px) {
                .mustvisit-intro .text {
                    font-size:1em;
                    line-height: 1.8em
                }
            }

            .mustvisit-note {
                border-top: 4px solid #ffe73d;
                background: url(/Content/images/content/must-visit/bg-style-1.png) #fff;
                background-size: 12px 12px;
                padding: 3.44828%;
                margin-bottom: 3.44828%
            }

            .mustvisit-note .text,.mustvisit-note .title {
                color: #000;
                margin: 0 auto .5em
            }

            .mustvisit-note .title {
                position: relative
            }

            @media (min-width: 0) and (max-width:767px) {
                .mustvisit-note {
                    background-size:15px 15px
                }

                .mustvisit-note .title {
                    background-size: 12px 12px;
                    font-size: 1.125em;
                    line-height: 1.46667em
                }

                .mustvisit-note .text {
                    font-size: .9375em;
                    line-height: 1.6em
                }
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .mustvisit-note .title {
                    font-size:1.25em;
                    line-height: 1.44em
                }

                .mustvisit-note .text {
                    font-size: 1em;
                    line-height: 1.5em
                }
            }

            @media (min-width: 1200px) {
                .mustvisit-note .title {
                    font-size:1.25em;
                    line-height: 1.44em
                }

                .mustvisit-note .text {
                    font-size: 1em;
                    line-height: 1.5em
                }
            }
            .page-header.mustvisit {
                position: relative;
                width: 100%
            }

            .page-header.mustvisit .thumb-frame {
                height: auto;
                padding-bottom: 0
            }
            .img-card img {
                display: block;
                width: 100%
            }
            .snacks-top .artical {
                background: rgba(132,38,1,.8);
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                padding: 5.17241vw 5.17241%
            }

            .snacks-top .artical .title {
                position: relative;
                color: #fff
            }

            .snacks-top .artical .title:after {
                content: "";
                position: absolute;
                bottom: 0;
                left: 0;
                display: inline-block;
                width: 30px;
                height: 6px;
                background: #ec6941
            }

            .snacks-top .artical .text {
                color: #fff
            }

            .snacks-top .page-list-card .item .thumb-frame {
                // padding-bottom: 100%;
                background: transparent;
            }

            .snacks-top .page-list-card .item .img-card img {
                display: block
            }

            .snacks-top .list-title {
                color: #e94f12
            }

            .snacks-top .info-blk .info-title {
                color: #000;
                font-size: 1.5em;
                line-height: 1.2em;
                margin-bottom: 2.29885%
            }

            .snacks-top .info-blk .rankings {
                display: inline-block;
                float: left;
                font-size: 1.5em;
                line-height: 1.25em;
                line-height: 1.25;
                color: #fff;
                background: #e94f12;
                text-align: center;
                width: 30px;
                height: 30px;
                vertical-align: middle;
                margin-right: 1.72414%
            }

            .snacks-top.for-Universiade .list-title {
                color: #1d83c1
            }

            .snacks-top.for-Universiade .info-blk .rankings {
                background: #1d83c1
            }

            @media (min-width: 0) and (max-width:767px) {
                .snacks-top .artical .title {
                    font-size:1.75em;
                    line-height: 1.02857em;
                    padding-bottom: 3.44828vw
                }

                .snacks-top .artical .text {
                    padding-top: .86207vw;
                    font-size: .9375em;
                    line-height: 1.92em
                }

                .snacks-top .page-header .img-card {
                    margin-bottom: 0
                }

                .snacks-top .img-card {
                    clear: both;
                    margin-bottom: 10px
                }

                .snacks-top .page-list-card .item {
                    margin-bottom: 60px
                }

                .snacks-top .info-blk {
                    clear: both;
                    position: relative
                }

                .snacks-top .info-blk .info-title {
                    font-weight: 700
                }

                .snacks-top .info-blk .rankings {
                    position: absolute;
                    top: -40px;
                    left: 0
                }
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .snacks-top .artical {
                    position:absolute;
                    top: 0;
                    margin: 0 25%;
                    width: 50%;
                    height: 100%;
                    padding: 3.19149vw 3.19149%
                }

                .snacks-top .artical .title {
                    font-size: 1.875em;
                    line-height: 1.6em;
                    vertical-align: bottom;
                    padding-bottom: 18px
                }

                .snacks-top .artical .text {
                    padding-top: 12px;
                    font-size: 1em;
                    line-height: 1.8em
                }

                .snacks-top .page-list-card .item {
                    margin-bottom: 36px
                }
            }

            @media (min-width: 1200px) {
                .snacks-top .artical {
                    position:absolute;
                    top: 0;
                    right: 0;
                    width: 40%;
                    height: 100%;
                    padding: 60px
                }

                .snacks-top .artical .title {
                    font-size: 2em;
                    line-height: .9em;
                    padding-bottom: 36px
                }

                .snacks-top .artical .text {
                    padding-top: 24px;
                    font-size: 1.125em;
                    line-height: 1.73333em
                }

                .snacks-top .page-list-card .item .img-card {
                    -webkit-box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    width: 31.91489%;
                    float: left;
                    margin-right: 2.12766%
                }

                .snacks-top .page-list-card .item .info-blk {
                    -webkit-box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    width: 65.95745%;
                    float: right;
                    margin-right: 0;
                    padding-left: 2.17391%
                }
            }
            .page-list-blk .list-title {
                font-size: 1.25em;
                line-height: 1.2em;
                padding: 15px 0
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .page-list-blk .list-title {
                    font-size:1.5em;
                    line-height: 2em
                }
            }

            @media (min-width: 1200px) {
                .page-list-blk .list-title {
                    font-size:1.5em;
                    line-height: 2em
                }
            }
.page-list-card {
                display: block;
                display: -webkit-flex;
                display: flex;
                -webkit-flex-flow: row wrap;
                flex-flow: row wrap
            }

            .page-list-card .item {
                margin-bottom: 3.44828vw
            }

            .page-list-card .info-blk .info-title {
                color: #1a1a1a;
                font-size: 1.5em;
                line-height: 2em
            }

            .page-list-card .info-blk .text {
                color: #1a1a1a;
                font-size: 1em;
                line-height: 1.8em
            }

            @media (min-width: 0) and (max-width:767px) {
                .page-list-card .item {
                    margin-bottom:10.34483vw
                }

                .page-list-card .item .img-card {
                    -webkit-box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    width: 100%;
                    float: left;
                    margin-left: 0;
                    margin-right: 0
                }
            }

            @media (min-width: 768px) and (max-width:1199px) {
                .page-list-card .item .img-card {
                    -webkit-box-sizing:border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    width: 32.86713%;
                    float: left;
                    margin-right: .6993%
                }

                .page-list-card .item .info-blk {
                    -webkit-box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    width: 66.43357%;
                    float: right;
                    margin-right: 0;
                    padding-left: 2.12766%
                }

                .page-list-card .info-blk .text {
                    font-size: 1em;
                    line-height: 1.8em
                }
            }

            @media (min-width: 1200px) {
                .page-list-card .item .img-card {
                    -webkit-box-sizing:border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    width: 31.91489%;
                    float: left;
                    margin-right: 2.12766%
                }

                .page-list-card .item .info-blk {
                    -webkit-box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    box-sizing: border-box;
                    width: 65.95745%;
                    float: right;
                    margin-right: 0;
                    padding-left: 2.17391%
                }

                .page-list-card .info-blk .text {
                    font-size: 1.125em;
                    line-height: 1.73333em
                }
            }
            @media (min-width: 768px) and (max-width:1199px) {

          .page-content-wrapper {
              padding: 3.19149vw 2.12766%
          }
        }
        @media (min-width: 0) and (max-width:767px) {
          .page-content-wrapper {
              padding:5.17241vw 3.44828%
          }
        }
</style>

