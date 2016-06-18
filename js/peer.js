var width = 400,
    height = 500;

var colours = ["#C44F00", "#6f9733","#0072bc", "#9B53C3", "#971919"],
    groupNames = ["You", "Following & following you", "Following you", "Following", "Other"];

var colourScale = d3.scale.ordinal()
        .range(colours),
    groupScale = d3.scale.ordinal()
        .range(groupNames); // ordinal scale to translate from groups to required text on page

var force = d3.layout.force()
    .charge(-300)
    .linkDistance(220)
    .friction(0.5)
    .size([width, height]);

var tip = d3.tip() // this is where the tooltip display text is configured
    .attr('class', 'd3-tip')
    .html(function(d) {
        return "<p class=\"tip-p\"><strong>" + groupScale(d.group) + "</strong></p><p class=\"tip-p\"><strong>Name:</strong> " + d.name + "</p><p class=\"tip-p\"><strong>Institution:</strong> " + d.institution + "</p>";
    });

var blankData = [{"key": "Full Name:", "value": ""},
                {"key":"Institution:", "value": ""},
                {"key":"Interests:", "value": ""},
                {"key":"City:", "value": ""},
                {"key":"Country:", "value": ""},
                {"key":" ", "value": ""}];

var headshotContainer = d3.select("#headshot");
var emailContainer = d3.select("#email");

var svg = d3.select("#chart").append("svg")
    .attr("width", width)
    .attr("height", height)
    .call(tip);

var table = d3.select("#table").append("table")
            .attr("class", "force"),
    tbody = table.append("tbody"),
    tableSwitch = true;


d3.json("getJSON.php", function(error, graph) {
    // changed to static (json) to work on machine w/o xampp
    if (error) console.log("There was an error loading the json " + error);

    //createTable(blankData)

    var groups = []; // TODO make this a function
    // note that group names change - perhaps create an ordinal scale to translate? 

    graph.nodes.forEach(function(d, i) {
        groups[i] = d.group;
    });

    groups.sort(d3.ascending);

    var groupDomain = findUnique(groups);

    colourScale.domain(groupDomain);
    groupScale.domain(groupDomain);

    svgLegend(groupDomain);

    force
        .nodes(graph.nodes)
        .links(graph.links)
        .linkStrength(function(d) {
            return +d.value;
        })
        .start();

    var path = svg.selectAll("path") //changed to path to allow arcs
    .data(graph.links)
        .enter().append("path")
        .attr("class", "path")
        .style("stroke-width", "1px");

    var node = svg.selectAll(".node")
        .data(graph.nodes)
        .enter().append("circle")
        .attr("class", "node")
        .attr("id", function (d) { return "no_" + d.group; })
        .attr("fill", function(d) {
            return colourScale(+d.group);
        })
        .call(force.drag)
        .on('click', function(d, i) {
            return legendUpdate(d);
        })
        .on('mouseover', tip.show)
        .on('mouseout', tip.hide);

    force.on("tick", function() {
        path.attr("d", linkArc);
        node.attr("cx", function(d) {
                return d.x;
            })
            .attr("cy", function(d) {
                return d.y;
            })
            .attr("r", function (d,i) {
                return (d.group === 0) ? "11px" : "7.5px";
            });
        });

    function linkArc(d) {
        var dx = d.target.x - d.source.x,
            dy = d.target.y - d.source.y,
            dr = Math.sqrt(dx * dx + dy * dy);
        return "M" + d.source.x + "," + d.source.y + "A" + dr + "," + dr + " 0 0,1 " + d.target.x + "," + d.target.y;
    }

    function createTableData(x) {
        var nodes = x.nodes
    }
});

function createTable (x) {
        //var tableDate = createTableData(graph)

    var columns = ["key", "values"]; 

    var rows = tbody.selectAll("tr")
                .data(x)
                .enter()
                .append("tr");

    var cells = rows.selectAll("td")
                .data(function(row) {
                    return columns.map(function(column) {
                        return {column: column, value: row[column]};
                    })
                })
                .enter()
                .append("td")
                .attr("class", "force")
                .attr("class", function(d,i) { 
                    return d.column 
                })
                .html(function(d) { 
                    console.log(d);
                    return d.value;
                });

}

function legendUpdate(x) { // this is where the legend text is configured

    if(tableSwitch) createTable(blankData);
    
    tableSwitch = false;

    //x.image = x.image//splitAt(x);

    var t = getDummyTable(x);

    var headshot = headshotContainer
        .selectAll("img")
        .data([x]);

    var tab = table
        .selectAll("td.values")
        .data(t);

    headshot.style("opacity", 1e-6);
    tab.style("opacity", 1e-6);

    headshot.enter()
        .append("img")
        .style("margin", "auto")
        .style("display", "block")
        .attr("width", "100px")
        .attr("height", "100px");

    tab.enter()
        .append("td");

    headshot.attr("src", function(d) { console.log(d);
        return d.image;
    })
        .transition()
        .duration(750)
        .style("opacity", 1);

    tab.html(function(d) {
        return d;
    })
        .transition()
        .duration(750)
        .style("opacity", 1);

    headshot.exit()
        .remove();

    tab.exit()
        .remove();

}

function svgLegend(data) { // adds the circles to the legend

    var addLegend = d3.select("#groupLegend");

    var legendPara = addLegend.selectAll("p")
        .data(data)
        .enter()
        .append("p");

        legendPara.attr("class", "legendPara")
        .append("svg")
        .attr("height", "20px")
        .attr("width", "20px")
        .append("circle")
        .attr("r", "6px")
        .attr("cx", "14px")
        .attr("cy", "14px")
        .attr("fill", function(d) {
            return colourScale(+d);
        })
        .on("mouseover", function(d,i){ console.log(this);
            var c = this.getAttribute("fill");
            d3.selectAll("#no_"+d).attr("fill", function () {console.log(d3.rgb(c));
                return d3.rgb(c).brighter(0.7);
            })
        })
        .on("mouseout", function(d,i){ console.log(this);
            d3.selectAll("#no_"+d).attr("fill", function () {
                return colourScale(d);
            })
        });

        legendPara.append("text")
        .attr("class", "textLegend")
        .text(function(d) {
            return groupScale(d);
        })
        .style("padding-left", "15px");

}

function splitAt(x) { // function to split email string and create text for image
    //console.log(x.name)
    var n = x.name.split("@");
    var images = "";
    var ans = images.concat(n[0], ".jpg")
    return ans;
}

function findUnique(a) {
    /*return a.reduce(function(p, c) {;
        if (p.indexOf(c) < 0) p.push(c);
        return p;
    }, []);*/
	return [0,1,2,3,4];
}

function getDummyTable(x) {
    var n = x.name.split("@");
    n.push(x.institution);
    n.push(x.interests);
    n.push(x.city);
    n.push(x.country);
	if(x.group > 3){
		n.push("<a href=\"javascript:acceptInvite("+"'"+x.email+"'"+");\" class=\"btnfollow\"><button class='btn'>Follow</button></a>");
	}else{
		 n.push('');
	}
    return n;
}