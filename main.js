
$(function()
{
	if (navigator.geolocation)
	{
		var optionObj = {
			'enableHighAccuracy': false,
			'timeout': 8000,
			'maximumAge': 5000
		};

		navigator.geolocation.getCurrentPosition(locationDidSucceed, locationDidError, optionObj);
	}
	else
	{
		alert('本サービスの利用には、位置情報取得機能が必要です。');
	}


	// var api = RESASAPI();
	// api.apikey("80T3ED5HQPCrNBCXk3wOfm6pquJmbbaUAJynnPJ3");

	// api.type("都道府県一覧");

	// api.param({
	//     "prefCode":"11",
	//     "sicCode":"E",
	//     "simcCode":"20",
	// });

	// api.on('load', function(data) {
	//     console.log(data)
	// });

	// api.send();
});

function isGifuPref(revGeoData)
{
	var count = revGeoData.length;
	var data = revGeoData[count-2]['formatted_address'].split(',');
	if (data[1].trim() === '岐阜県')
	{
		return true;
	}
	return false;
}

function locationDidSucceed(location)
{
	var geocoder = new google.maps.Geocoder();
	var latlng = {'lat': location.coords.latitude, 'lng': location.coords.longitude};
	geocoder.geocode({'location': latlng}, function(results, status)
	{
		if (status === google.maps.GeocoderStatus.OK)
		{
			if (isGifuPref(results))
			{
				
			}
		}
		else
		{
			console.log('Geocoder: ' + status);
		}
	});
}

function locationDidError()
{
	var errorMessage = {
		0: "原因不明のエラーが発生しました。",
		1: "位置情報の取得が許可されませんでした。",
		2: "電波状況などで位置情報が取得できませんでした。",
		3: "位置情報の取得に時間がかかり過ぎてタイムアウトしました。"
	};
	alert(errorMessage[error.code]);
}