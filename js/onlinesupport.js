var olsupport = '<div class="olsupport_side">' +
'	<ul>' +
'		<li class="qq">' +
'			<a href="http://wpa.qq.com/msgrd?v=3&uin=2853612105&Site=%E4%BA%91%E8%81%AA&Menu=yes" rel="nofollow" target="_blank">' +
'				<div class="sidebox"><i class="fa fa-qq"></i>QQ客服</div>' +
'			</a>' +
'		</li>' +
'		<li class="tel">' +
'			<a href="tel:0592-6010876">' +
'				<div class="sidebox"><i class="fa fa-phone"></i>0592-6010876</div>' +
'			</a>' +
'		</li>' +
'	</ul>' +
'</div>';
document.write(olsupport);

var blnUid = false;
layui.use('layim', function(layim){
	var socket = new WebSocket("ws://api.yunclever.com:8282");
	var layim = layui.layim;
	layim.config({
		init: {
			"mine": {
			  "username": "Online Chat"
			  ,"id": "10000"
			  ,"status": "online"
			  ,"sign": ""
			  ,"avatar": "http://cdn.yunclever.com/static/layui/images/Chat.png"
			}
		}
		,title: '访客即时会话'
		,min: true
		,right: '45%'
		,brief: false
		,isgroup: false
		,isfriend:false
		,notice: true
		,copyright: true
	});
	layim.on('sendMessage', function(res){
		if(blnUid){
			socket.send( JSON.stringify({
				type: 'chatMessage'
				,data: res
			}));
		}
	});
	socket.onopen = function(){
		if(!blnUid){		
			socket.send( JSON.stringify({
				type: 'reg'
				,data: { uid: '10000' }
			}));
			blnUid = true;		
		}
	};
	socket.onmessage = function(res) {
		rs = JSON.parse(res.data);
		if(rs.type === 'getMessage'){		
			layim.getMessage(rs.data);
		}
		else if(rs.type === 'addList'){
			//layim.addList(rs.data);
		}
	};
});