let isFinished = false;
TweenLite.set(".csd_logo_100x", { visibility: "visible" });
var tl = new TimelineMax({ yoyo: true, repeat: -1 });
tl.fromTo(
  ".c_group",
  0.6,
  { drawSVG: "50% 50%" },
  { delay: 0, drawSVG: "100% 0%", ease: Linear.easeNone }
);
tl.fromTo(
  "#icon_group",
  1,
  { fill: "none" },
  { delay: 0.2, fill: "#C0C0C0", fillOpacity: 0.7 }
);
