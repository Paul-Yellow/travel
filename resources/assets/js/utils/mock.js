export const Menu = [{
  name: '活动资讯',
  img: '/images/svg/icon-main-news.svg',
  menuSub:[{
      url: '/newevent',
      img: '/images/svg/event-01.svg',
      name: '最新活动'
  },{
      url: '/activeevent',
      img: '/images/svg/event-02.svg',
      name: '活动盛事'
  },{
      url: '/react-native',
      img: '/images/svg/media-05.svg',
      name: '观光app'
  },{
      url: '/offers',
      img: '/images/svg/event-04.svg',
      name: '优惠情报'
  }]
},{
  name: '玩转中源',
  img: '/images/svg/icon-main-play.svg',
  menuSub: [{
    url: '/zhongyuan',
    img: '/images/svg/Fun-01.svg',
    name: '认识中源'
  },{
    url: '/mustv-visit',
    img: '/images/svg/must-visit.svg',
    name: '中源必游'
  },{
    url: '/talent',
    img: '/images/svg/Fun-02.svg',
    name: '达人推荐'
  },{
    url: '/tags',
    img: '/images/svg/hot-tag.svg',
    name: '热门TAG'
  }]
},{
  name: '游玩景点',
  img: '/images/svg/icon-main-spot.svg',
  menuSub:[{
    url: '/attraction/category',
    img: '/images/svg/attraction-01.svg',
    name: '主题景点',
  },{
    url: '/attraction/list',
    img: '/images/svg/attraction-02.svg',
    name: '景点快搜',
  },{
    url: '/attraction/top',
    img: '/images/svg/attraction-04.svg',
    name: 'TOP10',
  }]
},{
  name: '家乡特产',
  img: '/images/svg/icon-main-shop.svg',
  menuSub:[{
    url: '/',
    img: '/images/svg/shop-01.svg',
    name: '主题特产',
  },{
    url: '/',
    img: '/images/svg/shop-02.svg',
    name: '主题特产搜索',
  },{
    url: '/',
    img: '/images/svg/shop-03.svg',
    name: '季节特产',
  },{
    url: '/',
    img: '/images/svg/shop-04.svg',
    name: '季节特产搜索',
  }]
},{
  name: '旅馆住宿',
  img: '/images/svg/icon-main-accommodation.svg',
  menuSub:[{
    url: '/',
    img: '/images/svg/accommodation-01.svg',
    name: '住宿类别',
  },{
    url: '/',
    img: '/images/svg/accommodation-03.svg',
    name: '住宿快搜',
  },{
    url: '/acc/noticelist',
    img: '/images/svg/accommodation-02.svg',
    name: '住宿须知',
  },{
    url: '/',
    img: '/images/svg/less-than-1500.svg',
    name: '低价房间',
  }]
},{
  name: '旅游咨询',
  img: '/images/svg/icon-main-info.svg',
  menuSub:[{
    url: '/information/trafficlist',
    img: '/images/svg/information-01.svg',
    name: '交通资讯'
  },{
    url: '/information/server/index',
    img: '/images/svg/information-02.svg',
    name: '客户服务'
  },{
    url: '/information/tipslist/index',
    img: '/images/svg/information-03.svg',
    name: '旅游须知'
  },{
    url: '/',
    img: '/images/svg/information-04.svg',
    name: '政府信息'
  }]
},{
  name: '影像资料',
  img: '/images/svg/icon-main-media.svg',
  menuSub:[{
    url: '/',
    img: '/images/svg/media-01.svg',
    name: '热门视频'
  },{
    url: '/',
    img: '/images/svg/media-02.svg',
    name: '照片欣赏'
  },{
    url: '/',
    img: '/images/svg/media-03.svg',
    name: '风景欣赏'
  },{
    url: '/',
    img: '/images/svg/media-04.svg',
    name: '历史记忆'
  }]
}];



// 住宿须知
export const noticelist = [{
  name: '历年优良旅馆',
  url: '/acc/noticelist/linian',
  img: '/images/acc/01.svg'
},{
  name: '住宿安全',
  url: '/acc/noticelist/security',
  img: '/images/acc/02.svg'
},{
  name: '旅馆标章说明',
  url: '/acc/noticelist/bilingual',
  img: '/images/acc/03.svg'
},{
  name: '旅馆双语标示',
  url: '/acc/noticelist/mark',
  img: '/images/acc/04.svg'
},{
  name: '建筑安全检测',
  url: '/acc/noticelist/check',
  img: '/images/acc/05.svg'
},{
  name: '公告注销',
  url: '/acc/noticelist/cancel',
  img: '/images/acc/06.svg'
},{
  name: '温泉标章',
  url: '/acc/noticelist/wenquan',
  img: '/images/acc/07.svg'
}];
export const trafficlist = [{
  name: '昌北机场到中原',
  url: '/information/trafficlist/changbei',
  img: '/images/info/01.svg'
},{
  name: '高铁到中原',
  url: '/information/trafficlist/gaotie',
  img: '/images/info/02.svg'
},{
  name: '火车站到中原',
  url: '/information/trafficlist/huoche',
  img: '/images/info/03.svg'
},{
  name: '汽车站到中原',
  url: '/information/trafficlist/qiche',
  img: '/images/info/04.svg'
},{
  name: '共享单车',
  url: '/information/trafficlist/danche',
  img: '/images/info/05.svg'
}];
export const server = [{
  name: '常用服务热线',
  url: '/information/server/rexian',
  img:'/images/server/01.svg'
},{
  name: '常见问题',
  url: '/information/server/faq',
  img:'/images/server/02.svg'
},{
  name: '链接专区',
  url: '/information/server/link',
  img:'/images/server/03.svg'
}];
export const tipslist = [{
  name: '登山需要注意事项',
  url: '/information/tipslist/dengshan',
  img: '/images/server/t01.svg'
},{
  name: '用电注意事项',
  url: '/information/tipslist/yongdian',
  img: '/images/server/t02.svg'
},{
  name: '急难救治',
  url: '/information/tipslist/jinan',
  img: '/images/server/t03.svg'
},{
  name: '旅馆标识',
  url: '/information/tipslist/biaoshi',
  img: '/images/server/t04.svg'
}];
export const attraction = [{
  id:1,
  category_id: 1,
  name: '养生温泉',
  img: '/images/acc/wenquan.svg'
},{
  id:2,
  category_id: 2,
  name: '单车骑行',
  img: '/images/acc/danche.svg'
},{
  id:3,
  category_id:3,
  name: '历史建筑',
  img: '/images/acc/lishi.svg'
},{
  id:4,
  category_id: 4,
  name: '宗教信仰',
  img: '/images/acc/zongjiao.svg'
},{
  id:5,
  category_id: 5,
  name: '艺文所馆',
  img: '/images/acc/jianzu.svg'
},{
  id:6,
  cateory_id: 6,
  name: '公共艺术',
  img: '/images/acc/yishu.svg'
},{
  id:7,
  category_id: 7,
  name: '户外踏青',
  img: '/images/acc/taqing.svg'
},{
  id:8,
  category_id: 8,
  name: '蓝色公路',
  img: '/images/acc/gonglu.svg'
},{
  id:9,
  category_id: 9,
  name: '亲子游玩',
  img: '/images/acc/qinzi.svg'
},{
  id:10,
  category_id: 10,
  name: '宝宝基地',
  img: '/images/acc/beibebi.svg'
},{
  id:11,
  category_id: 11,
  name: '夜市商圈',
  img: '/images/acc/yeshi.svg'
},{
  id:12,
  category_id: 12,
  name: '主题商街',
  img: '/images/acc/shangjie.svg'
}];
export const topMock = [{
  id: 1,
  name: '九岭尖游玩',
  img: '/images/fengmian/jiuling.jpg',
  url: ''
},{
  id: 2,
  name: '白沙坪游玩',
  img: '/images/fengmian/shi.jpg',
  url: ''
},{
  id: 3,
  name: '西岭梯田游玩',
  img: '/images/fengmian/titian2.jpg',
  url: ''
},{
  id: 4,
  name: '白崖山游玩',
  img: '/images/fengmian/tujuan1.jpg',
  url: ''
},{
  id: 5,
  name: '三爪仑游玩',
  img: '/images/bg/bg-007.jpg',
  url: ''
},{
  id: 6,
  name: '九仙温泉',
  img: '/images/mustv/wenquan.jpg',
  url: ''
}];