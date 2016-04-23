var express= require('express');
var cheerio= require('cheerio');
var request= require('request');
var fs= require('fs');

var app=express();  //creating an express application
app.use(express.static(__dirname + '/public'));

app.get('/',function(req,res){
	//web_scraping script will come here --- function is a callback

	// *****scraping Dawn News*****
	url="http://www.dawn.com/";
	res.set('Content-Type', 'text/html');
	request(url,function(error,response,html){
		if(!error)
		{
			var $ = cheerio.load(html);
			// console.log(html);
			var headlines=[];
			var temp;
			// var json={title:""};

			// var $ =  cheerio.load('<article data-type="story">hello</article>');
			temp=$("article[data-type='story']").children().first().children().first().text(); //for getting headline of top-story
			console.log(temp);
			headlines.push(temp);
			var count=0;			
			// getting the rest of the stories-limit to 10 stories (total)
			$("article.story.soft-half--bottom[data-type='story']").each(function(){
				count++;
				if(count<9)
				{
					temp=$(this).children().eq(1).children().first().text();
					console.log(temp);
					headlines.push(temp);
				}
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('dawn.json',json,function(err){
				if(!err)
					console.log("output file created...");
			});
		}
	});

	// *****scraping BBC News*****
	url="http://www.bbc.com/news/";
	request(url,function(error,response,html){
		if(!error)
		{
			var $=cheerio.load(html);
			var headlines=[];
			var temp,count=0;
			temp=$(".top-story-header").children().first().text();
			console.log(temp);
			headlines.push(temp);
			$(".secondary-story-header").each(function(){
				temp=$(this).children().first().text();
				console.log(temp);
				headlines.push(temp);
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('bbc.json',json,function(err){
				if(!err)
					console.log("next output created");
			});
			// res.send("Check console...BBC's headlines added!");
		}
	});

	// *****scraping Express Tribune*****
	url="http://tribune.com.pk/";
	request(url,function(error,response,html){
		if(!error)
		{
			var $=cheerio.load(html);
			var headlines=[];
			var temp,count=0;
			temp=$("h1.title").children().first().text();
			console.log(temp);
			headlines.push(temp);
			$("h2.title").each(function(){
				count++;
				if(count<5)
				{
					temp=$(this).children().first().text();
					console.log(temp);
					headlines.push(temp);
				}
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('tribune.json',json,function(err){
				if(!err)
					console.log("next output created");
			});
			// res.send("Check console...Tribune's headlines added!");
		}
	});

	// *****scraping Al-Jazeera*****
	url="http://www.aljazeera.com/";
	request(url,function(error,response,html){
		if(!error)
		{
			var $=cheerio.load(html);
			var headlines=[];
			var temp,count=0;
			temp=$("td.wp_posting_ws_right_head").children().first().text();
			console.log(temp);
			headlines.push(temp);
			$("a.indexText-Bold2.indexText-Font2").each(function(){
				count++;
				if(count<4)
				{
					temp=$(this).text();
					console.log(temp);
					headlines.push(temp);
				}
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('aljazeera.json',json,function(err){
				if(!err)
					console.log("next output created");
			});
			// res.send("Check console...Tribune's headlines added!");
		}
	});

	// *****scraping Sky News*****
	url="http://news.sky.com/";
	request(url,function(error,response,html){
		if(!error)
		{
			var $=cheerio.load(html);
			var headlines=[];
			var temp,count=0;
			temp=$("span.headline.headline--breaking.headline--section-top-stories").text();
			console.log(temp);
			headlines.push(temp);
			$("span.headline.headline--normal.headline--section-top-stories").each(function(){
				count++;
				if(count<4)
				{
					temp=$(this).text();
					console.log(temp);
					headlines.push(temp);
				}
			});
			var json=JSON.stringify(headlines);
			fs.writeFile('skynews.json',json,function(err){
				if(!err)
					console.log("next output created");
			});
			// res.send("Check console...Tribune's headlines added!");
		}
	});

    res.sendFile("index.html", {root: "."});

}).listen(8082);
console.log("Server started...scraping content...");