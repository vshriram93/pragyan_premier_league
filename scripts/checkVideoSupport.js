function checkVideo()
{
var support=0;
if(!!document.createElement('video').canPlayType)
{
var vidTest=document.createElement("video");
oggTest=vidTest.canPlayType('video/ogg; codecs="theora, vorbis"');
if (!oggTest)
{
h264Test=vidTest.canPlayType('video/mp4; codecs="avc1.42E01E, mp4a.40.2"');
if (!h264Test)
{
	support=0;
}
else
{
if (h264Test=="probably")
{
	support=1;
}
else
{
	support=1;
}
}
}
else
{
if (oggTest=="probably")
{
	support=1;
}
else
{
	support=1;
}
}
}
else
{
	support=0;
}
}