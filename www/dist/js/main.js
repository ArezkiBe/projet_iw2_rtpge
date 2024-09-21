window.addEventListener("load", () => {
  document.querySelectorAll(".navbar_toggle_button").forEach((t) => {
    const n = document.createElement("span");
    t.append(n), t.onclick = () => {
      const e = t.getAttribute("data-target"), a = document.querySelector(e);
      a.classList.toggle("toggled"), t.classList.toggle("toggled"), a.classList.contains("toggled") ? a.style.maxHeight = a.scrollHeight + "px" : a.style.maxHeight = 0;
    };
  });
});
window.addEventListener("load", () => {
  document.querySelectorAll(".slider").forEach((t) => {
    t.getAttribute("data-options"), p(t);
  });
});
const p = (t, n) => {
  const s = {
    width: t.getAttribute("data-width") ? t.getAttribute("data-width") : 360,
    height: t.getAttribute("data-height") ? t.getAttribute("data-height") : 240
  };
  t.style.height = s.height + "px", t.style.width = s.width + "px";
  const o = document.createElement("div");
  o.classList.add("slider_viewport"), t.append(o), t.querySelectorAll("img").forEach((g) => {
    const c = document.createElement("div");
    c.classList.add("slider_slide"), c.append(g), o.append(c);
  });
  const d = document.createElement("div");
  d.classList.add("slider_nav"), t.append(d);
  const r = document.createElement("button");
  r.classList.add("slider_nav_prev"), r.innerHTML = "", r.addEventListener("click", () => {
    l(-1, t);
  }), d.append(r);
  const i = document.createElement("button");
  i.classList.add("slider_nav_next"), i.innerHTML = "", i.addEventListener("click", () => {
    l(1, t);
  }), d.append(i);
}, l = (t, n) => {
  let e = Number(
    n.getAttribute("data-current") ? n.getAttribute("data-current") : 0
  );
  e += t;
  const s = n.querySelectorAll(".slider_slide").length;
  e = e % s, e = e >= 0 ? e : s + e, n.setAttribute("data-current", e);
  const o = e * -100 + "%", d = n.querySelector(".slider_viewport");
  d.style.left = o, d.addEventListener("transitonend", u), d.removeEventListener("transitonend", u);
}, u = () => {
};
document.addEventListener("DOMContentLoaded", () => {
  const t = document.getElementById("page-content"), n = document.querySelectorAll(".component");
  Sortable.create(t, {}), console.log("test"), n.forEach((e) => {
    e.addEventListener("dragstart", (a) => {
      a.dataTransfer.setData("text/plain", e.dataset.type);
    });
  });
});
