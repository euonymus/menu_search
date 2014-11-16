<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>sencha</title>
<link rel="stylesheet" href="/lib/resources/css/sencha-touch.css" type="text/css">
<script type="text/javascript" src="/lib/sencha-touch-all.js"></script>
<script>
Ext.application({
	launch: function() {
	Ext.Viewport.add({
		xtype: 'panel',
		items: [
		{
			xtype: 'label',
			html: 'Sencha TouchでWebアプリを開発'
		}]
		});
	}
});
</script>
</head>
<body></body>
</html>