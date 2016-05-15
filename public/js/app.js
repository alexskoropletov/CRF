$(function () {
    $.plot(
        "#placeholder",
        [
            //{data: openBid, label: "Open Bid"},
            {data: openAsk, label: "Open ask"},
            //{data: closeBid, label: "close Bid"},
            {data: closeAsk, label: "close ask"}
        ],
        {
            xaxes: [{
                mode: "time",
                timeformat: "%d.%m.%Y %H:00"
            }],
            yaxes: [],
        }
    );
    $("#placeholder").bind("plotpan", function (event, plot) {
        var axes = plot.getAxes();
    }).bind("plotzoom", function (event, plot) {
        var axes = plot.getAxes();
    });
});
