function valid_mt_opener(e,t){try{return t&&t.TvrLang&&!t.closed&&t.document.domain.indexOf(e.document.domain)>-1}catch(e){return!1}}var MTdetached,MTWindow=!!valid_mt_opener(window,window.opener)&&window.opener,MTDetachedWindow=!0;MTWindow&&MTWindow.TvrMT?jQuery(document).ready(function(e){var t,n,d,i,o,a,r;(MTdetached={stat:{tvr:e("#tvr"),front:e("#v-frontend-wrap"),frontInner:e("#v-frontend"),html:e("html")},set_vars:function(){MTWindow=window.opener,t=MTWindow.TvrMT,n=t.TvrUi,i=t.TvrCom,o=t.tvrsprintf,a=MTWindow.TvrLang,r=t.mod.MTsave,t.MTdetached=MTdetached,t.detachedWin=window,d?t.MTF=d:d=t.MTF},iframe_loaded:function(){d=MTWindow.TvrMT.MTF},init:function(){if(this.set_vars(),MTlocal.set_vars(),!n.preview_is_detached||!n.preview_is_detached())return MTdetached.deactivate_window(),!1;n.placeholderFrame=!0,MTlocal.maybe_load_site_preview(),MTlocal.apply_rulers(),n.default_to_tab("mq"),this.setup_event_listeners()},setup_event_listeners:function(){MTlocal.add_window_resize_listener(!0)},deactivate_window:function(){this.stat.front.addClass("window-inactive"),this.stat.frontInner.remove(),MTdetached=!1,window=!1},remove_window_inactive_notice:function(){this.stat.front.removeClass("window-inactive")},add_html_class:function(e){this.stat.tvr.addClass(e)},remove_html_class:function(e){this.stat.tvr.removeClass(e)}}).init()}):jQuery(document).ready(function(e){document.getElementById("v-frontend-wrap").classList.add("window-inactive")});