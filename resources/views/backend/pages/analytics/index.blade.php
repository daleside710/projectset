@extends('backend.layouts.master')
@section('title','Statistikk')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="chartjs-size-monitor"
                                     style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                    <div class="chartjs-size-monitor-expand"
                                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink"
                                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <h6 class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <span>Conversion Rate</span>
                                    <span class="avatar">
                                            <span class="avatar-title bg-success text-white rounded-circle">
                                                <i class="fa fa-percent"></i>
                                            </span>
                                        </span>
                                </h6>
                                <div class="d-flex d-sm-block d-lg-flex align-items-end mb-3">
                                    <h3 class="mb-0 mr-2">0.19%</h3>
                                    <p class="small text-muted mb-0 line-height-20">
                                        <span class="text-success">+ 1.2%</span> than last week
                                    </p>
                                </div>
                                <canvas id="widget-chart1" height="29" width="174" class="chartjs-render-monitor"
                                        style="display: block; width: 174px; height: 29px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="chartjs-size-monitor"
                                     style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                    <div class="chartjs-size-monitor-expand"
                                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink"
                                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <h6 class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <span>Unique Purchases</span>
                                    <span class="avatar">
                                            <span class="avatar-title bg-warning text-white rounded-circle">
                                                <i class="fa fa-dollar"></i>
                                            </span>
                                        </span>
                                </h6>
                                <div class="d-flex d-sm-block d-lg-flex align-items-end mb-3">
                                    <h3 class="mb-0 mr-2">3,137</h3>
                                    <p class="small text-muted mb-0 line-height-20">
                                        <span class="text-danger">-1.2%</span> than last week
                                    </p>
                                </div>
                                <canvas id="widget-chart2" height="29" width="174" class="chartjs-render-monitor"
                                        style="display: block; width: 174px; height: 29px;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="chartjs-size-monitor"
                                     style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;">
                                    <div class="chartjs-size-monitor-expand"
                                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink"
                                         style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                        <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                                    </div>
                                </div>
                                <h6 class="card-title d-flex align-items-start justify-content-between mb-0">
                                    <span>Order Quantity</span>
                                    <span class="avatar">
                                            <span class="avatar-title bg-danger text-white rounded-circle">
                                                <i class="fa fa-cube"></i>
                                            </span>
                                        </span>
                                </h6>
                                <div class="d-flex d-sm-block d-lg-flex align-items-end mb-3">
                                    <h3 class="mb-0 mr-2">1,650</h3>
                                    <p class="small text-muted mb-0 line-height-20">
                                        <span class="text-success">+ 2.1%</span> than last week
                                    </p>
                                </div>
                                <canvas id="widget-chart3" height="29" width="174" class="chartjs-render-monitor"
                                        style="display: block; width: 174px; height: 29px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body" style="position: relative;">
                                <h6 class="card-title d-flex justify-content-between">
                                    <span>Sales this month</span>
                                    <span class="dropdown">
                                            <a href="#" data-toggle="dropdown" aria-haspopup="true"
                                               aria-expanded="false">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <span class="dropdown-menu dropdown-menu-right">
                                                <a href="#" class="dropdown-item">Action</a>
                                                <a href="#" class="dropdown-item">Another action</a>
                                                <a href="#" class="dropdown-item">Something else here</a>
                                            </span>
                                        </span>
                                </h6>
                                <div id="chart1" style="min-height: 390px;">
                                    <div id="apexchartsjo6pv2wm" class="apexcharts-canvas apexchartsjo6pv2wm light"
                                         style="width: 414px; height: 375px;">
                                        <svg id="SvgjsSvg1630" width="414" height="375"
                                             xmlns="http://www.w3.org/2000/svg" version="1.1"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg"
                                             xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                             style="background: transparent;">
                                            <foreignObject x="0" y="0" width="414" height="375">
                                                <div class="apexcharts-legend center position-bottom"
                                                     xmlns="http://www.w3.org/1999/xhtml"
                                                     style="right: 0px; position: absolute; left: 0px; top: auto; bottom: 10px;">
                                                    <div class="apexcharts-legend-series" rel="1" data:collapsed="false"
                                                         style="margin: 0px 5px;"><span class="apexcharts-legend-marker"
                                                                                        rel="1" data:collapsed="false"
                                                                                        style="background: rgb(0, 143, 251); color: rgb(0, 143, 251); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span
                                                                class="apexcharts-legend-text" rel="1"
                                                                data:collapsed="false"
                                                                style="color: rgb(55, 61, 63); font-size: 12px; font-family: Helvetica, Arial, sans-serif;">Net Profit</span>
                                                    </div>
                                                    <div class="apexcharts-legend-series" rel="2" data:collapsed="false"
                                                         style="margin: 0px 5px;"><span class="apexcharts-legend-marker"
                                                                                        rel="2" data:collapsed="false"
                                                                                        style="background: rgb(0, 227, 150); color: rgb(0, 227, 150); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span
                                                                class="apexcharts-legend-text" rel="2"
                                                                data:collapsed="false"
                                                                style="color: rgb(55, 61, 63); font-size: 12px; font-family: Helvetica, Arial, sans-serif;">Revenue</span>
                                                    </div>
                                                    <div class="apexcharts-legend-series" rel="3" data:collapsed="false"
                                                         style="margin: 0px 5px;"><span class="apexcharts-legend-marker"
                                                                                        rel="3" data:collapsed="false"
                                                                                        style="background: rgb(254, 176, 25); color: rgb(254, 176, 25); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span><span
                                                                class="apexcharts-legend-text" rel="3"
                                                                data:collapsed="false"
                                                                style="color: rgb(55, 61, 63); font-size: 12px; font-family: Helvetica, Arial, sans-serif;">Free Cash Flow</span>
                                                    </div>
                                                </div>
                                                <style type="text/css">

                                                    .apexcharts-legend {
                                                        display: flex;
                                                        overflow: auto;
                                                        padding: 0 10px;
                                                    }

                                                    .apexcharts-legend.position-bottom, .apexcharts-legend.position-top {
                                                        flex-wrap: wrap
                                                    }

                                                    .apexcharts-legend.position-right, .apexcharts-legend.position-left {
                                                        flex-direction: column;
                                                        bottom: 0;
                                                    }

                                                    .apexcharts-legend.position-bottom.left, .apexcharts-legend.position-top.left, .apexcharts-legend.position-right, .apexcharts-legend.position-left {
                                                        justify-content: flex-start;
                                                    }

                                                    .apexcharts-legend.position-bottom.center, .apexcharts-legend.position-top.center {
                                                        justify-content: center;
                                                    }

                                                    .apexcharts-legend.position-bottom.right, .apexcharts-legend.position-top.right {
                                                        justify-content: flex-end;
                                                    }

                                                    .apexcharts-legend-series {
                                                        cursor: pointer;
                                                        line-height: normal;
                                                    }

                                                    .apexcharts-legend.position-bottom .apexcharts-legend-series, .apexcharts-legend.position-top .apexcharts-legend-series {
                                                        display: flex;
                                                        align-items: center;
                                                    }

                                                    .apexcharts-legend-text {
                                                        position: relative;
                                                        font-size: 14px;
                                                    }

                                                    .apexcharts-legend-text *, .apexcharts-legend-marker * {
                                                        pointer-events: none;
                                                    }

                                                    .apexcharts-legend-marker {
                                                        position: relative;
                                                        display: inline-block;
                                                        cursor: pointer;
                                                        margin-right: 3px;
                                                    }

                                                    .apexcharts-legend.right .apexcharts-legend-series, .apexcharts-legend.left .apexcharts-legend-series {
                                                        display: inline-block;
                                                    }

                                                    .apexcharts-legend-series.no-click {
                                                        cursor: auto;
                                                    }

                                                    .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
                                                        display: none !important;
                                                    }

                                                    .inactive-legend {
                                                        opacity: 0.45;
                                                    }</style>
                                            </foreignObject>
                                            <g id="SvgjsG1632" class="apexcharts-inner apexcharts-graphical"
                                               transform="translate(55.34375, 40)">
                                                <defs id="SvgjsDefs1631">
                                                    <linearGradient id="SvgjsLinearGradient1635" x1="0" y1="0" x2="0"
                                                                    y2="1">
                                                        <stop id="SvgjsStop1636" stop-opacity="0.4"
                                                              stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                        <stop id="SvgjsStop1637" stop-opacity="0.5"
                                                              stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                        <stop id="SvgjsStop1638" stop-opacity="0.5"
                                                              stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                    </linearGradient>
                                                    <clipPath id="gridRectMaskjo6pv2wm">
                                                        <rect id="SvgjsRect1640" width="350.65625" height="280.348"
                                                              x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1"
                                                              stroke-width="0" stroke="none"
                                                              stroke-dasharray="0"></rect>
                                                    </clipPath>
                                                    <clipPath id="gridRectMarkerMaskjo6pv2wm">
                                                        <rect id="SvgjsRect1641" width="350.65625" height="280.348"
                                                              x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1"
                                                              stroke-width="0" stroke="none"
                                                              stroke-dasharray="0"></rect>
                                                    </clipPath>
                                                </defs>
                                                <rect id="SvgjsRect1639" width="7.102256944444445" height="278.348"
                                                      x="0" y="0" rx="0" ry="0" fill="url(#SvgjsLinearGradient1635)"
                                                      opacity="1" stroke-width="0" stroke-dasharray="3"
                                                      class="apexcharts-xcrosshairs" y2="278.348" filter="none"
                                                      fill-opacity="0.9"></rect>
                                                <g id="SvgjsG1677" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                    <g id="SvgjsG1678" class="apexcharts-xaxis-texts-g"
                                                       transform="translate(0, -4)">
                                                        <text id="SvgjsText1679"
                                                              font-family="Helvetica, Arial, sans-serif"
                                                              x="19.369791666666668" y="307.348" text-anchor="middle"
                                                              dominant-baseline="auto" font-size="12px" fill="#373d3f"
                                                              class="apexcharts-xaxis-label "
                                                              style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1680"
                                                                   style="font-family: Helvetica, Arial, sans-serif;">
                                                                Feb
                                                            </tspan>
                                                            <title>Feb</title></text>
                                                        <text id="SvgjsText1681"
                                                              font-family="Helvetica, Arial, sans-serif" x="58.109375"
                                                              y="307.348" text-anchor="middle" dominant-baseline="auto"
                                                              font-size="12px" fill="#373d3f"
                                                              class="apexcharts-xaxis-label "
                                                              style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1682"
                                                                   style="font-family: Helvetica, Arial, sans-serif;">
                                                                Mar
                                                            </tspan>
                                                            <title>Mar</title></text>
                                                        <text id="SvgjsText1683"
                                                              font-family="Helvetica, Arial, sans-serif"
                                                              x="96.84895833333333" y="307.348" text-anchor="middle"
                                                              dominant-baseline="auto" font-size="12px" fill="#373d3f"
                                                              class="apexcharts-xaxis-label "
                                                              style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1684"
                                                                   style="font-family: Helvetica, Arial, sans-serif;">
                                                                Apr
                                                            </tspan>
                                                            <title>Apr</title></text>
                                                        <text id="SvgjsText1685"
                                                              font-family="Helvetica, Arial, sans-serif"
                                                              x="135.58854166666669" y="307.348" text-anchor="middle"
                                                              dominant-baseline="auto" font-size="12px" fill="#373d3f"
                                                              class="apexcharts-xaxis-label "
                                                              style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1686"
                                                                   style="font-family: Helvetica, Arial, sans-serif;">
                                                                May
                                                            </tspan>
                                                            <title>May</title></text>
                                                        <text id="SvgjsText1687"
                                                              font-family="Helvetica, Arial, sans-serif"
                                                              x="174.32812500000003" y="307.348" text-anchor="middle"
                                                              dominant-baseline="auto" font-size="12px" fill="#373d3f"
                                                              class="apexcharts-xaxis-label "
                                                              style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1688"
                                                                   style="font-family: Helvetica, Arial, sans-serif;">
                                                                Jun
                                                            </tspan>
                                                            <title>Jun</title></text>
                                                        <text id="SvgjsText1689"
                                                              font-family="Helvetica, Arial, sans-serif"
                                                              x="213.06770833333337" y="307.348" text-anchor="middle"
                                                              dominant-baseline="auto" font-size="12px" fill="#373d3f"
                                                              class="apexcharts-xaxis-label "
                                                              style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1690"
                                                                   style="font-family: Helvetica, Arial, sans-serif;">
                                                                Jul
                                                            </tspan>
                                                            <title>Jul</title></text>
                                                        <text id="SvgjsText1691"
                                                              font-family="Helvetica, Arial, sans-serif"
                                                              x="251.8072916666667" y="307.348" text-anchor="middle"
                                                              dominant-baseline="auto" font-size="12px" fill="#373d3f"
                                                              class="apexcharts-xaxis-label "
                                                              style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1692"
                                                                   style="font-family: Helvetica, Arial, sans-serif;">
                                                                Aug
                                                            </tspan>
                                                            <title>Aug</title></text>
                                                        <text id="SvgjsText1693"
                                                              font-family="Helvetica, Arial, sans-serif" x="290.546875"
                                                              y="307.348" text-anchor="middle" dominant-baseline="auto"
                                                              font-size="12px" fill="#373d3f"
                                                              class="apexcharts-xaxis-label "
                                                              style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1694"
                                                                   style="font-family: Helvetica, Arial, sans-serif;">
                                                                Sep
                                                            </tspan>
                                                            <title>Sep</title></text>
                                                        <text id="SvgjsText1695"
                                                              font-family="Helvetica, Arial, sans-serif"
                                                              x="329.2864583333333" y="307.348" text-anchor="middle"
                                                              dominant-baseline="auto" font-size="12px" fill="#373d3f"
                                                              class="apexcharts-xaxis-label "
                                                              style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan1696"
                                                                   style="font-family: Helvetica, Arial, sans-serif;">
                                                                Oct
                                                            </tspan>
                                                            <title>Oct</title></text>
                                                    </g>
                                                    <line id="SvgjsLine1697" x1="0" y1="279.348" x2="348.65625"
                                                          y2="279.348" stroke="#78909c" stroke-dasharray="0"
                                                          stroke-width="1"></line>
                                                </g>
                                                <g id="SvgjsG1707" class="apexcharts-grid">
                                                    <g id="SvgjsG1708" class="apexcharts-gridlines-horizontal">
                                                        <line id="SvgjsLine1718" x1="0" y1="0" x2="348.65625" y2="0"
                                                              stroke="#e0e0e0" stroke-dasharray="0"
                                                              class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1719" x1="0" y1="46.391333333333336"
                                                              x2="348.65625" y2="46.391333333333336" stroke="#e0e0e0"
                                                              stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1720" x1="0" y1="92.78266666666667"
                                                              x2="348.65625" y2="92.78266666666667" stroke="#e0e0e0"
                                                              stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1721" x1="0" y1="139.174" x2="348.65625"
                                                              y2="139.174" stroke="#e0e0e0" stroke-dasharray="0"
                                                              class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1722" x1="0" y1="185.56533333333334"
                                                              x2="348.65625" y2="185.56533333333334" stroke="#e0e0e0"
                                                              stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1723" x1="0" y1="231.95666666666668"
                                                              x2="348.65625" y2="231.95666666666668" stroke="#e0e0e0"
                                                              stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        <line id="SvgjsLine1724" x1="0" y1="278.348" x2="348.65625"
                                                              y2="278.348" stroke="#e0e0e0" stroke-dasharray="0"
                                                              class="apexcharts-gridline"></line>
                                                    </g>
                                                    <g id="SvgjsG1709" class="apexcharts-gridlines-vertical"></g>
                                                    <line id="SvgjsLine1710" x1="38.739583333333336" y1="279.348"
                                                          x2="38.739583333333336" y2="285.348" stroke="#78909c"
                                                          stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1711" x1="77.47916666666667" y1="279.348"
                                                          x2="77.47916666666667" y2="285.348" stroke="#78909c"
                                                          stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1712" x1="116.21875" y1="279.348" x2="116.21875"
                                                          y2="285.348" stroke="#78909c" stroke-dasharray="0"
                                                          class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1713" x1="154.95833333333334" y1="279.348"
                                                          x2="154.95833333333334" y2="285.348" stroke="#78909c"
                                                          stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1714" x1="193.69791666666669" y1="279.348"
                                                          x2="193.69791666666669" y2="285.348" stroke="#78909c"
                                                          stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1715" x1="232.43750000000003" y1="279.348"
                                                          x2="232.43750000000003" y2="285.348" stroke="#78909c"
                                                          stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1716" x1="271.17708333333337" y1="279.348"
                                                          x2="271.17708333333337" y2="285.348" stroke="#78909c"
                                                          stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1717" x1="309.9166666666667" y1="279.348"
                                                          x2="309.9166666666667" y2="285.348" stroke="#78909c"
                                                          stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                                                    <line id="SvgjsLine1726" x1="0" y1="278.348" x2="348.65625"
                                                          y2="278.348" stroke="transparent" stroke-dasharray="0"></line>
                                                    <line id="SvgjsLine1725" x1="0" y1="1" x2="0" y2="278.348"
                                                          stroke="transparent" stroke-dasharray="0"></line>
                                                </g>
                                                <g id="SvgjsG1643" class="apexcharts-bar-series apexcharts-plot-series">
                                                    <g id="SvgjsG1644" class="apexcharts-series" rel="1"
                                                       seriesName="NetxProfit" data:realIndex="0">
                                                        <path id="apexcharts-bar-area-0"
                                                              d="M 8.71640625 278.348L 8.71640625 177.06263090277778Q 11.267534722222223 175.51150243055557 13.818663194444445 177.06263090277778L 13.818663194444445 278.348L 7.71640625 278.348"
                                                              fill="rgba(0,143,251,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 8.71640625 278.348L 8.71640625 177.06263090277778Q 11.267534722222223 175.51150243055557 13.818663194444445 177.06263090277778L 13.818663194444445 278.348L 7.71640625 278.348"
                                                              pathFrom="M 8.71640625 278.348L 8.71640625 278.348L 13.818663194444445 278.348L 13.818663194444445 278.348L 7.71640625 278.348"
                                                              cy="176.28706666666668" cx="46.455989583333334" j="0"
                                                              val="44" barHeight="102.06093333333334"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-0"
                                                              d="M 47.455989583333334 278.348L 47.455989583333334 151.54739756944446Q 50.00711805555556 149.99626909722224 52.55824652777778 151.54739756944446L 52.55824652777778 278.348L 46.455989583333334 278.348"
                                                              fill="rgba(0,143,251,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 47.455989583333334 278.348L 47.455989583333334 151.54739756944446Q 50.00711805555556 149.99626909722224 52.55824652777778 151.54739756944446L 52.55824652777778 278.348L 46.455989583333334 278.348"
                                                              pathFrom="M 47.455989583333334 278.348L 47.455989583333334 278.348L 52.55824652777778 278.348L 52.55824652777778 278.348L 46.455989583333334 278.348"
                                                              cy="150.77183333333335" cx="85.19557291666666" j="1"
                                                              val="55" barHeight="127.57616666666667"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-0"
                                                              d="M 86.19557291666666 278.348L 86.19557291666666 146.9082642361111Q 88.74670138888888 145.3571357638889 91.29782986111111 146.9082642361111L 91.29782986111111 278.348L 85.19557291666666 278.348"
                                                              fill="rgba(0,143,251,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 86.19557291666666 278.348L 86.19557291666666 146.9082642361111Q 88.74670138888888 145.3571357638889 91.29782986111111 146.9082642361111L 91.29782986111111 278.348L 85.19557291666666 278.348"
                                                              pathFrom="M 86.19557291666666 278.348L 86.19557291666666 278.348L 91.29782986111111 278.348L 91.29782986111111 278.348L 85.19557291666666 278.348"
                                                              cy="146.1327" cx="123.93515625" j="2" val="57"
                                                              barHeight="132.2153" barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-0"
                                                              d="M 124.93515625 278.348L 124.93515625 149.22783090277778Q 127.48628472222222 147.67670243055557 130.03741319444444 149.22783090277778L 130.03741319444444 278.348L 123.93515625 278.348"
                                                              fill="rgba(0,143,251,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 124.93515625 278.348L 124.93515625 149.22783090277778Q 127.48628472222222 147.67670243055557 130.03741319444444 149.22783090277778L 130.03741319444444 278.348L 123.93515625 278.348"
                                                              pathFrom="M 124.93515625 278.348L 124.93515625 278.348L 130.03741319444444 278.348L 130.03741319444444 278.348L 123.93515625 278.348"
                                                              cy="148.45226666666667" cx="162.67473958333335" j="3"
                                                              val="56" barHeight="129.89573333333334"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-0"
                                                              d="M 163.67473958333335 278.348L 163.67473958333335 137.62999756944447Q 166.22586805555557 136.07886909722225 168.77699652777778 137.62999756944447L 168.77699652777778 278.348L 162.67473958333335 278.348"
                                                              fill="rgba(0,143,251,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 163.67473958333335 278.348L 163.67473958333335 137.62999756944447Q 166.22586805555557 136.07886909722225 168.77699652777778 137.62999756944447L 168.77699652777778 278.348L 162.67473958333335 278.348"
                                                              pathFrom="M 163.67473958333335 278.348L 163.67473958333335 278.348L 168.77699652777778 278.348L 168.77699652777778 278.348L 162.67473958333335 278.348"
                                                              cy="136.85443333333336" cx="201.4143229166667" j="4"
                                                              val="61" barHeight="141.49356666666665"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-0"
                                                              d="M 202.4143229166667 278.348L 202.4143229166667 144.58869756944446Q 204.9654513888889 143.03756909722225 207.51657986111113 144.58869756944446L 207.51657986111113 278.348L 201.4143229166667 278.348"
                                                              fill="rgba(0,143,251,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 202.4143229166667 278.348L 202.4143229166667 144.58869756944446Q 204.9654513888889 143.03756909722225 207.51657986111113 144.58869756944446L 207.51657986111113 278.348L 201.4143229166667 278.348"
                                                              pathFrom="M 202.4143229166667 278.348L 202.4143229166667 278.348L 207.51657986111113 278.348L 207.51657986111113 278.348L 201.4143229166667 278.348"
                                                              cy="143.81313333333335" cx="240.15390625000003" j="5"
                                                              val="58" barHeight="134.53486666666666"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-0"
                                                              d="M 241.15390625000003 278.348L 241.15390625000003 132.99086423611112Q 243.70503472222225 131.4397357638889 246.25616319444447 132.99086423611112L 246.25616319444447 278.348L 240.15390625000003 278.348"
                                                              fill="rgba(0,143,251,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 241.15390625000003 278.348L 241.15390625000003 132.99086423611112Q 243.70503472222225 131.4397357638889 246.25616319444447 132.99086423611112L 246.25616319444447 278.348L 240.15390625000003 278.348"
                                                              pathFrom="M 241.15390625000003 278.348L 241.15390625000003 278.348L 246.25616319444447 278.348L 246.25616319444447 278.348L 240.15390625000003 278.348"
                                                              cy="132.2153" cx="278.89348958333335" j="6" val="63"
                                                              barHeight="146.1327" barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-0"
                                                              d="M 279.89348958333335 278.348L 279.89348958333335 139.94956423611112Q 282.44461805555557 138.3984357638889 284.9957465277778 139.94956423611112L 284.9957465277778 278.348L 278.89348958333335 278.348"
                                                              fill="rgba(0,143,251,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 279.89348958333335 278.348L 279.89348958333335 139.94956423611112Q 282.44461805555557 138.3984357638889 284.9957465277778 139.94956423611112L 284.9957465277778 278.348L 278.89348958333335 278.348"
                                                              pathFrom="M 279.89348958333335 278.348L 279.89348958333335 278.348L 284.9957465277778 278.348L 284.9957465277778 278.348L 278.89348958333335 278.348"
                                                              cy="139.174" cx="317.63307291666666" j="7" val="60"
                                                              barHeight="139.174" barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-0"
                                                              d="M 318.63307291666666 278.348L 318.63307291666666 126.03216423611113Q 321.1842013888889 124.48103576388891 323.7353298611111 126.03216423611113L 323.7353298611111 278.348L 317.63307291666666 278.348"
                                                              fill="rgba(0,143,251,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 318.63307291666666 278.348L 318.63307291666666 126.03216423611113Q 321.1842013888889 124.48103576388891 323.7353298611111 126.03216423611113L 323.7353298611111 278.348L 317.63307291666666 278.348"
                                                              pathFrom="M 318.63307291666666 278.348L 318.63307291666666 278.348L 323.7353298611111 278.348L 323.7353298611111 278.348L 317.63307291666666 278.348"
                                                              cy="125.25660000000002" cx="356.37265625" j="8" val="66"
                                                              barHeight="153.0914" barWidth="7.102256944444445"></path>
                                                        <g id="SvgjsG1645" class="apexcharts-datalabels"></g>
                                                    </g>
                                                    <g id="SvgjsG1655" class="apexcharts-series" rel="2"
                                                       seriesName="Revenue" data:realIndex="1">
                                                        <path id="apexcharts-bar-area-1"
                                                              d="M 15.818663194444445 278.348L 15.818663194444445 102.83649756944445Q 18.369791666666668 101.28536909722223 20.92092013888889 102.83649756944445L 20.92092013888889 278.348L 14.818663194444445 278.348"
                                                              fill="rgba(0,227,150,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 15.818663194444445 278.348L 15.818663194444445 102.83649756944445Q 18.369791666666668 101.28536909722223 20.92092013888889 102.83649756944445L 20.92092013888889 278.348L 14.818663194444445 278.348"
                                                              pathFrom="M 15.818663194444445 278.348L 15.818663194444445 278.348L 20.92092013888889 278.348L 20.92092013888889 278.348L 14.818663194444445 278.348"
                                                              cy="102.06093333333334" cx="53.55824652777778" j="0"
                                                              val="76" barHeight="176.28706666666668"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-1"
                                                              d="M 54.55824652777778 278.348L 54.55824652777778 81.96039756944447Q 57.10937500000001 80.40926909722225 59.66050347222223 81.96039756944447L 59.66050347222223 278.348L 53.55824652777778 278.348"
                                                              fill="rgba(0,227,150,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 54.55824652777778 278.348L 54.55824652777778 81.96039756944447Q 57.10937500000001 80.40926909722225 59.66050347222223 81.96039756944447L 59.66050347222223 278.348L 53.55824652777778 278.348"
                                                              pathFrom="M 54.55824652777778 278.348L 54.55824652777778 278.348L 59.66050347222223 278.348L 59.66050347222223 278.348L 53.55824652777778 278.348"
                                                              cy="81.18483333333336" cx="92.29782986111111" j="1"
                                                              val="85" barHeight="197.16316666666665"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-1"
                                                              d="M 93.29782986111111 278.348L 93.29782986111111 44.8473309027778Q 95.84895833333333 43.296202430555574 98.40008680555556 44.8473309027778L 98.40008680555556 278.348L 92.29782986111111 278.348"
                                                              fill="rgba(0,227,150,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 93.29782986111111 278.348L 93.29782986111111 44.8473309027778Q 95.84895833333333 43.296202430555574 98.40008680555556 44.8473309027778L 98.40008680555556 278.348L 92.29782986111111 278.348"
                                                              pathFrom="M 93.29782986111111 278.348L 93.29782986111111 278.348L 98.40008680555556 278.348L 98.40008680555556 278.348L 92.29782986111111 278.348"
                                                              cy="44.07176666666669" cx="131.03741319444444" j="2"
                                                              val="101" barHeight="234.27623333333332"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-1"
                                                              d="M 132.03741319444444 278.348L 132.03741319444444 51.80603090277779Q 134.58854166666666 50.25490243055557 137.13967013888887 51.80603090277779L 137.13967013888887 278.348L 131.03741319444444 278.348"
                                                              fill="rgba(0,227,150,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 132.03741319444444 278.348L 132.03741319444444 51.80603090277779Q 134.58854166666666 50.25490243055557 137.13967013888887 51.80603090277779L 137.13967013888887 278.348L 131.03741319444444 278.348"
                                                              pathFrom="M 132.03741319444444 278.348L 132.03741319444444 278.348L 137.13967013888887 278.348L 137.13967013888887 278.348L 131.03741319444444 278.348"
                                                              cy="51.03046666666668" cx="169.77699652777778" j="3"
                                                              val="98" barHeight="227.31753333333333"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-1"
                                                              d="M 170.77699652777778 278.348L 170.77699652777778 77.32126423611112Q 173.328125 75.7701357638889 175.87925347222222 77.32126423611112L 175.87925347222222 278.348L 169.77699652777778 278.348"
                                                              fill="rgba(0,227,150,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 170.77699652777778 278.348L 170.77699652777778 77.32126423611112Q 173.328125 75.7701357638889 175.87925347222222 77.32126423611112L 175.87925347222222 278.348L 169.77699652777778 278.348"
                                                              pathFrom="M 170.77699652777778 278.348L 170.77699652777778 278.348L 175.87925347222222 278.348L 175.87925347222222 278.348L 169.77699652777778 278.348"
                                                              cy="76.54570000000001" cx="208.51657986111113" j="4"
                                                              val="87" barHeight="201.8023"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-1"
                                                              d="M 209.51657986111113 278.348L 209.51657986111113 35.56906423611113Q 212.06770833333334 34.01793576388891 214.61883680555556 35.56906423611113L 214.61883680555556 278.348L 208.51657986111113 278.348"
                                                              fill="rgba(0,227,150,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 209.51657986111113 278.348L 209.51657986111113 35.56906423611113Q 212.06770833333334 34.01793576388891 214.61883680555556 35.56906423611113L 214.61883680555556 278.348L 208.51657986111113 278.348"
                                                              pathFrom="M 209.51657986111113 278.348L 209.51657986111113 278.348L 214.61883680555556 278.348L 214.61883680555556 278.348L 208.51657986111113 278.348"
                                                              cy="34.79350000000002" cx="247.25616319444447" j="5"
                                                              val="105" barHeight="243.5545"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-1"
                                                              d="M 248.25616319444447 278.348L 248.25616319444447 68.04299756944445Q 250.80729166666669 66.49186909722224 253.3584201388889 68.04299756944445L 253.3584201388889 278.348L 247.25616319444447 278.348"
                                                              fill="rgba(0,227,150,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 248.25616319444447 278.348L 248.25616319444447 68.04299756944445Q 250.80729166666669 66.49186909722224 253.3584201388889 68.04299756944445L 253.3584201388889 278.348L 247.25616319444447 278.348"
                                                              pathFrom="M 248.25616319444447 278.348L 248.25616319444447 278.348L 253.3584201388889 278.348L 253.3584201388889 278.348L 247.25616319444447 278.348"
                                                              cy="67.26743333333334" cx="285.9957465277778" j="6"
                                                              val="91" barHeight="211.08056666666667"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-1"
                                                              d="M 286.9957465277778 278.348L 286.9957465277778 14.692964236111099Q 289.546875 13.141835763888876 292.0980034722222 14.692964236111099L 292.0980034722222 278.348L 285.9957465277778 278.348"
                                                              fill="rgba(0,227,150,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 286.9957465277778 278.348L 286.9957465277778 14.692964236111099Q 289.546875 13.141835763888876 292.0980034722222 14.692964236111099L 292.0980034722222 278.348L 285.9957465277778 278.348"
                                                              pathFrom="M 286.9957465277778 278.348L 286.9957465277778 278.348L 292.0980034722222 278.348L 292.0980034722222 278.348L 285.9957465277778 278.348"
                                                              cy="13.917399999999986" cx="324.7353298611111" j="7"
                                                              val="114" barHeight="264.4306"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-1"
                                                              d="M 325.7353298611111 278.348L 325.7353298611111 61.08429756944446Q 328.2864583333333 59.533169097222235 330.83758680555553 61.08429756944446L 330.83758680555553 278.348L 324.7353298611111 278.348"
                                                              fill="rgba(0,227,150,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="1"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 325.7353298611111 278.348L 325.7353298611111 61.08429756944446Q 328.2864583333333 59.533169097222235 330.83758680555553 61.08429756944446L 330.83758680555553 278.348L 324.7353298611111 278.348"
                                                              pathFrom="M 325.7353298611111 278.348L 325.7353298611111 278.348L 330.83758680555553 278.348L 330.83758680555553 278.348L 324.7353298611111 278.348"
                                                              cy="60.30873333333335" cx="363.4749131944444" j="8"
                                                              val="94" barHeight="218.03926666666666"
                                                              barWidth="7.102256944444445"></path>
                                                        <g id="SvgjsG1656" class="apexcharts-datalabels"></g>
                                                    </g>
                                                    <g id="SvgjsG1666" class="apexcharts-series" rel="3"
                                                       seriesName="FreexCashxFlow" data:realIndex="2">
                                                        <path id="apexcharts-bar-area-2"
                                                              d="M 22.92092013888889 278.348L 22.92092013888889 197.9387309027778Q 25.472048611111113 196.38760243055557 28.023177083333334 197.9387309027778L 28.023177083333334 278.348L 21.92092013888889 278.348"
                                                              fill="rgba(254,176,25,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 22.92092013888889 278.348L 22.92092013888889 197.9387309027778Q 25.472048611111113 196.38760243055557 28.023177083333334 197.9387309027778L 28.023177083333334 278.348L 21.92092013888889 278.348"
                                                              pathFrom="M 22.92092013888889 278.348L 22.92092013888889 278.348L 28.023177083333334 278.348L 28.023177083333334 278.348L 21.92092013888889 278.348"
                                                              cy="197.16316666666668" cx="60.660503472222224" j="0"
                                                              val="35" barHeight="81.18483333333333"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-2"
                                                              d="M 61.660503472222224 278.348L 61.660503472222224 184.02133090277778Q 64.21163194444445 182.47020243055556 66.76276041666667 184.02133090277778L 66.76276041666667 278.348L 60.660503472222224 278.348"
                                                              fill="rgba(254,176,25,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 61.660503472222224 278.348L 61.660503472222224 184.02133090277778Q 64.21163194444445 182.47020243055556 66.76276041666667 184.02133090277778L 66.76276041666667 278.348L 60.660503472222224 278.348"
                                                              pathFrom="M 61.660503472222224 278.348L 61.660503472222224 278.348L 66.76276041666667 278.348L 66.76276041666667 278.348L 60.660503472222224 278.348"
                                                              cy="183.24576666666667" cx="99.40008680555556" j="1"
                                                              val="41" barHeight="95.10223333333333"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-2"
                                                              d="M 100.40008680555556 278.348L 100.40008680555556 195.61916423611112Q 102.95121527777778 194.0680357638889 105.50234375000001 195.61916423611112L 105.50234375000001 278.348L 99.40008680555556 278.348"
                                                              fill="rgba(254,176,25,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 100.40008680555556 278.348L 100.40008680555556 195.61916423611112Q 102.95121527777778 194.0680357638889 105.50234375000001 195.61916423611112L 105.50234375000001 278.348L 99.40008680555556 278.348"
                                                              pathFrom="M 100.40008680555556 278.348L 100.40008680555556 278.348L 105.50234375000001 278.348L 105.50234375000001 278.348L 99.40008680555556 278.348"
                                                              cy="194.8436" cx="138.1396701388889" j="2" val="36"
                                                              barHeight="83.5044" barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-2"
                                                              d="M 139.1396701388889 278.348L 139.1396701388889 218.81483090277777Q 141.69079861111112 217.26370243055555 144.24192708333334 218.81483090277777L 144.24192708333334 278.348L 138.1396701388889 278.348"
                                                              fill="rgba(254,176,25,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 139.1396701388889 278.348L 139.1396701388889 218.81483090277777Q 141.69079861111112 217.26370243055555 144.24192708333334 218.81483090277777L 144.24192708333334 278.348L 138.1396701388889 278.348"
                                                              pathFrom="M 139.1396701388889 278.348L 139.1396701388889 278.348L 144.24192708333334 278.348L 144.24192708333334 278.348L 138.1396701388889 278.348"
                                                              cy="218.03926666666666" cx="176.87925347222225" j="3"
                                                              val="26" barHeight="60.308733333333336"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-2"
                                                              d="M 177.87925347222225 278.348L 177.87925347222225 174.74306423611114Q 180.43038194444446 173.19193576388892 182.98151041666668 174.74306423611114L 182.98151041666668 278.348L 176.87925347222225 278.348"
                                                              fill="rgba(254,176,25,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 177.87925347222225 278.348L 177.87925347222225 174.74306423611114Q 180.43038194444446 173.19193576388892 182.98151041666668 174.74306423611114L 182.98151041666668 278.348L 176.87925347222225 278.348"
                                                              pathFrom="M 177.87925347222225 278.348L 177.87925347222225 278.348L 182.98151041666668 278.348L 182.98151041666668 278.348L 176.87925347222225 278.348"
                                                              cy="173.96750000000003" cx="215.6188368055556" j="4"
                                                              val="45" barHeight="104.3805"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-2"
                                                              d="M 216.6188368055556 278.348L 216.6188368055556 167.78436423611112Q 219.1699652777778 166.2332357638889 221.72109375000002 167.78436423611112L 221.72109375000002 278.348L 215.6188368055556 278.348"
                                                              fill="rgba(254,176,25,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 216.6188368055556 278.348L 216.6188368055556 167.78436423611112Q 219.1699652777778 166.2332357638889 221.72109375000002 167.78436423611112L 221.72109375000002 278.348L 215.6188368055556 278.348"
                                                              pathFrom="M 216.6188368055556 278.348L 216.6188368055556 278.348L 221.72109375000002 278.348L 221.72109375000002 278.348L 215.6188368055556 278.348"
                                                              cy="167.0088" cx="254.35842013888893" j="5" val="48"
                                                              barHeight="111.3392" barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-2"
                                                              d="M 255.35842013888893 278.348L 255.35842013888893 158.50609756944445Q 257.9095486111112 156.95496909722223 260.4606770833334 158.50609756944445L 260.4606770833334 278.348L 254.35842013888893 278.348"
                                                              fill="rgba(254,176,25,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 255.35842013888893 278.348L 255.35842013888893 158.50609756944445Q 257.9095486111112 156.95496909722223 260.4606770833334 158.50609756944445L 260.4606770833334 278.348L 254.35842013888893 278.348"
                                                              pathFrom="M 255.35842013888893 278.348L 255.35842013888893 278.348L 260.4606770833334 278.348L 260.4606770833334 278.348L 254.35842013888893 278.348"
                                                              cy="157.73053333333334" cx="293.0980034722222" j="6"
                                                              val="52" barHeight="120.61746666666667"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-2"
                                                              d="M 294.0980034722222 278.348L 294.0980034722222 156.1865309027778Q 296.64913194444443 154.6354024305556 299.20026041666665 156.1865309027778L 299.20026041666665 278.348L 293.0980034722222 278.348"
                                                              fill="rgba(254,176,25,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 294.0980034722222 278.348L 294.0980034722222 156.1865309027778Q 296.64913194444443 154.6354024305556 299.20026041666665 156.1865309027778L 299.20026041666665 278.348L 293.0980034722222 278.348"
                                                              pathFrom="M 294.0980034722222 278.348L 294.0980034722222 278.348L 299.20026041666665 278.348L 299.20026041666665 278.348L 293.0980034722222 278.348"
                                                              cy="155.4109666666667" cx="331.83758680555553" j="7"
                                                              val="53" barHeight="122.93703333333333"
                                                              barWidth="7.102256944444445"></path>
                                                        <path id="apexcharts-bar-area-2"
                                                              d="M 332.83758680555553 278.348L 332.83758680555553 184.02133090277778Q 335.38871527777775 182.47020243055556 337.93984374999997 184.02133090277778L 337.93984374999997 278.348L 331.83758680555553 278.348"
                                                              fill="rgba(254,176,25,1)" fill-opacity="1"
                                                              stroke="transparent" stroke-opacity="1"
                                                              stroke-linecap="butt" stroke-width="2"
                                                              stroke-dasharray="0" class="apexcharts-bar-area" index="2"
                                                              clip-path="url(#gridRectMaskjo6pv2wm)"
                                                              pathTo="M 332.83758680555553 278.348L 332.83758680555553 184.02133090277778Q 335.38871527777775 182.47020243055556 337.93984374999997 184.02133090277778L 337.93984374999997 278.348L 331.83758680555553 278.348"
                                                              pathFrom="M 332.83758680555553 278.348L 332.83758680555553 278.348L 337.93984374999997 278.348L 337.93984374999997 278.348L 331.83758680555553 278.348"
                                                              cy="183.24576666666667" cx="370.57717013888885" j="8"
                                                              val="41" barHeight="95.10223333333333"
                                                              barWidth="7.102256944444445"></path>
                                                        <g id="SvgjsG1667" class="apexcharts-datalabels"></g>
                                                    </g>
                                                </g>
                                                <line id="SvgjsLine1727" x1="0" y1="0" x2="348.65625" y2="0"
                                                      stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1"
                                                      class="apexcharts-ycrosshairs"></line>
                                                <line id="SvgjsLine1728" x1="0" y1="0" x2="348.65625" y2="0"
                                                      stroke-dasharray="0" stroke-width="0"
                                                      class="apexcharts-ycrosshairs-hidden"></line>
                                                <g id="SvgjsG1729" class="apexcharts-yaxis-annotations"></g>
                                                <g id="SvgjsG1730" class="apexcharts-xaxis-annotations"></g>
                                                <g id="SvgjsG1731" class="apexcharts-point-annotations"></g>
                                            </g>
                                            <g id="SvgjsG1698" class="apexcharts-yaxis" rel="0"
                                               transform="translate(22.34375, 0)">
                                                <g id="SvgjsG1699" class="apexcharts-yaxis-texts-g">
                                                    <text id="SvgjsText1700" font-family="Helvetica, Arial, sans-serif"
                                                          x="20" y="41.6" text-anchor="end" dominant-baseline="auto"
                                                          font-size="11px" fill="#373d3f"
                                                          class="apexcharts-yaxis-label "
                                                          style="font-family: Helvetica, Arial, sans-serif;">120
                                                    </text>
                                                    <text id="SvgjsText1701" font-family="Helvetica, Arial, sans-serif"
                                                          x="20" y="88.09133333333332" text-anchor="end"
                                                          dominant-baseline="auto" font-size="11px" fill="#373d3f"
                                                          class="apexcharts-yaxis-label "
                                                          style="font-family: Helvetica, Arial, sans-serif;">100
                                                    </text>
                                                    <text id="SvgjsText1702" font-family="Helvetica, Arial, sans-serif"
                                                          x="20" y="134.58266666666665" text-anchor="end"
                                                          dominant-baseline="auto" font-size="11px" fill="#373d3f"
                                                          class="apexcharts-yaxis-label "
                                                          style="font-family: Helvetica, Arial, sans-serif;">80
                                                    </text>
                                                    <text id="SvgjsText1703" font-family="Helvetica, Arial, sans-serif"
                                                          x="20" y="181.07399999999998" text-anchor="end"
                                                          dominant-baseline="auto" font-size="11px" fill="#373d3f"
                                                          class="apexcharts-yaxis-label "
                                                          style="font-family: Helvetica, Arial, sans-serif;">60
                                                    </text>
                                                    <text id="SvgjsText1704" font-family="Helvetica, Arial, sans-serif"
                                                          x="20" y="227.5653333333333" text-anchor="end"
                                                          dominant-baseline="auto" font-size="11px" fill="#373d3f"
                                                          class="apexcharts-yaxis-label "
                                                          style="font-family: Helvetica, Arial, sans-serif;">40
                                                    </text>
                                                    <text id="SvgjsText1705" font-family="Helvetica, Arial, sans-serif"
                                                          x="20" y="274.0566666666667" text-anchor="end"
                                                          dominant-baseline="auto" font-size="11px" fill="#373d3f"
                                                          class="apexcharts-yaxis-label "
                                                          style="font-family: Helvetica, Arial, sans-serif;">20
                                                    </text>
                                                    <text id="SvgjsText1706" font-family="Helvetica, Arial, sans-serif"
                                                          x="20" y="320.548" text-anchor="end" dominant-baseline="auto"
                                                          font-size="11px" fill="#373d3f"
                                                          class="apexcharts-yaxis-label "
                                                          style="font-family: Helvetica, Arial, sans-serif;">0
                                                    </text>
                                                </g>
                                            </g>
                                        </svg>
                                        <div class="apexcharts-tooltip light">
                                            <div class="apexcharts-tooltip-title"
                                                 style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                            <div class="apexcharts-tooltip-series-group"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(0, 143, 251);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                     style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-label"></span><span
                                                                class="apexcharts-tooltip-text-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-tooltip-series-group"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(0, 227, 150);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                     style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-label"></span><span
                                                                class="apexcharts-tooltip-text-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-tooltip-series-group"><span
                                                        class="apexcharts-tooltip-marker"
                                                        style="background-color: rgb(254, 176, 25);"></span>
                                                <div class="apexcharts-tooltip-text"
                                                     style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                    <div class="apexcharts-tooltip-y-group"><span
                                                                class="apexcharts-tooltip-text-label"></span><span
                                                                class="apexcharts-tooltip-text-value"></span></div>
                                                    <div class="apexcharts-tooltip-z-group"><span
                                                                class="apexcharts-tooltip-text-z-label"></span><span
                                                                class="apexcharts-tooltip-text-z-value"></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="resize-triggers">
                                    <div class="expand-trigger">
                                        <div style="width: 451px; height: 471px;"></div>
                                    </div>
                                    <div class="contract-trigger"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Total Customers</h6>
                                <div class="text-center">
                                    <div class="mb-2">
                                        <span class="bar-1" style="display: none;">2,5,9,6,5,2,4,3,7,5</span>
                                        <svg class="peity" height="50" width="100">
                                            <rect data-value="2" fill="rgb(0, 77, 235)" x="1" y="38.888888888888886"
                                                  width="8" height="11.111111111111114"></rect>
                                            <rect data-value="5" fill="rgba(0, 77, 235, 0.3)" x="11.000000000000002"
                                                  y="22.22222222222222" width="7.999999999999998"
                                                  height="27.77777777777778"></rect>
                                            <rect data-value="9" fill="rgb(0, 77, 235)" x="21" y="0" width="8"
                                                  height="50"></rect>
                                            <rect data-value="6" fill="rgba(0, 77, 235, 0.3)" x="31"
                                                  y="16.66666666666667" width="8" height="33.33333333333333"></rect>
                                            <rect data-value="5" fill="rgb(0, 77, 235)" x="40.99999999999999"
                                                  y="22.22222222222222" width="8.000000000000014"
                                                  height="27.77777777777778"></rect>
                                            <rect data-value="2" fill="rgba(0, 77, 235, 0.3)" x="50.99999999999999"
                                                  y="38.888888888888886" width="8.000000000000007"
                                                  height="11.111111111111114"></rect>
                                            <rect data-value="4" fill="rgb(0, 77, 235)" x="61" y="27.77777777777778"
                                                  width="8" height="22.22222222222222"></rect>
                                            <rect data-value="3" fill="rgba(0, 77, 235, 0.3)" x="71"
                                                  y="33.333333333333336" width="8" height="16.666666666666664"></rect>
                                            <rect data-value="7" fill="rgb(0, 77, 235)" x="81" y="11.111111111111107"
                                                  width="8" height="38.88888888888889"></rect>
                                            <rect data-value="5" fill="rgba(0, 77, 235, 0.3)" x="91"
                                                  y="22.22222222222222" width="8" height="27.77777777777778"></rect>
                                        </svg>
                                    </div>
                                    <div class="font-size-30 mb-1 font-weight-bold text-primary">1.241</div>
                                    <p class="mb-0 text-muted">
                                        <i class="fa fa-caret-up text-primary m-r-5"></i> 23% increase in Last week
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Average Order Value</h6>
                                <div class="text-center">
                                    <div class="mb-2">
                                        <span class="bar-3" style="display: none;">2,5,9,6,5,2,4,3,7,5</span>
                                        <svg class="peity" height="50" width="100">
                                            <rect data-value="2" fill="rgb(16, 183, 89)" x="1" y="38.888888888888886"
                                                  width="8" height="11.111111111111114"></rect>
                                            <rect data-value="5" fill="rgba(16, 183, 89, 0.3)" x="11.000000000000002"
                                                  y="22.22222222222222" width="7.999999999999998"
                                                  height="27.77777777777778"></rect>
                                            <rect data-value="9" fill="rgb(16, 183, 89)" x="21" y="0" width="8"
                                                  height="50"></rect>
                                            <rect data-value="6" fill="rgba(16, 183, 89, 0.3)" x="31"
                                                  y="16.66666666666667" width="8" height="33.33333333333333"></rect>
                                            <rect data-value="5" fill="rgb(16, 183, 89)" x="40.99999999999999"
                                                  y="22.22222222222222" width="8.000000000000014"
                                                  height="27.77777777777778"></rect>
                                            <rect data-value="2" fill="rgba(16, 183, 89, 0.3)" x="50.99999999999999"
                                                  y="38.888888888888886" width="8.000000000000007"
                                                  height="11.111111111111114"></rect>
                                            <rect data-value="4" fill="rgb(16, 183, 89)" x="61" y="27.77777777777778"
                                                  width="8" height="22.22222222222222"></rect>
                                            <rect data-value="3" fill="rgba(16, 183, 89, 0.3)" x="71"
                                                  y="33.333333333333336" width="8" height="16.666666666666664"></rect>
                                            <rect data-value="7" fill="rgb(16, 183, 89)" x="81" y="11.111111111111107"
                                                  width="8" height="38.88888888888889"></rect>
                                            <rect data-value="5" fill="rgba(16, 183, 89, 0.3)" x="91"
                                                  y="22.22222222222222" width="8" height="27.77777777777778"></rect>
                                        </svg>
                                    </div>
                                    <div class="font-size-30 mb-1 font-weight-bold text-success">$732.52</div>
                                    <p class="mb-0 text-muted">
                                        <i class="fa fa-caret-down text-danger m-r-5"></i> 4 lead less than last
                                        week
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title d-md-flex justify-content-between">
                                    Your Most Recent Earnings
                                    <span class="reportrange btn btn-outline-light btn-sm mt-3 mt-md-0">
                                            <i class="ti-calendar mr-2"></i>
                                            <span class="text">February 27, 2020 - March 27, 2020</span>
                                            <i class="ti-angle-down ml-2"></i>
                                        </span>
                                </h6>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="card border mb-3">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-block mr-3 icon-block-lg icon-block-outline-success text-success">
                                                        <i class="fa fa-bar-chart"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="text-uppercase font-size-11">Gross Earnings</h6>
                                                        <h4 class="mb-0">$1,958,104</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border mb-3">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-block mr-3 icon-block-lg icon-block-outline-danger  text-danger">
                                                        <i class="fa fa-hand-lizard-o"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="text-uppercase font-size-11">Tax Withheld</h6>
                                                        <h4 class="mb-0">$234,769</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border mb-3">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="icon-block mr-3 icon-block-lg icon-block-outline-warning text-warning">
                                                        <i class="fa fa-dollar"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="text-uppercase font-size-11">Net Earnings</h6>
                                                        <h4 class="mb-0">$1,608,469</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Sales Count</th>
                                                    <th>Gross Earnings</th>
                                                    <th>Tax Withheld</th>
                                                    <th class="text-right">Net Earnings</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>03/15/2018</td>
                                                    <td>1,050</td>
                                                    <td class="text-success">+ $32,580.00</td>
                                                    <td class="text-danger">- $3,023.10</td>
                                                    <td class="text-right">$28,670.90</td>
                                                </tr>
                                                <tr>
                                                    <td>03/14/2018</td>
                                                    <td>780</td>
                                                    <td class="text-success">+ $30,065.10</td>
                                                    <td class="text-danger">- $2,780.00</td>
                                                    <td class="text-right">$26,930.40</td>
                                                </tr>
                                                <tr>
                                                    <td>03/13/2018</td>
                                                    <td>1.980</td>
                                                    <td class="text-success">+ $30,065.10</td>
                                                    <td class="text-danger">- $2,780.00</td>
                                                    <td class="text-right">$26,930.40</td>
                                                </tr>
                                                <tr>
                                                    <td>03/12/2018</td>
                                                    <td>300</td>
                                                    <td class="text-success">+ $30,065.10</td>
                                                    <td class="text-danger">- $2,780.00</td>
                                                    <td class="text-right">$26,930.40</td>
                                                </tr>
                                                <tr>
                                                    <td>03/11/2018</td>
                                                    <td>940</td>
                                                    <td class="text-success">+ $30,065.10</td>
                                                    <td class="text-danger">- $2,780.00</td>
                                                    <td class="text-right">$26,930.40</td>
                                                </tr>
                                                <tr>
                                                    <td>03/10/2018</td>
                                                    <td>1.280</td>
                                                    <td class="text-success">+ $30,065.10</td>
                                                    <td class="text-danger">-$2,780.00</td>
                                                    <td class="text-right">$26,930.40</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection