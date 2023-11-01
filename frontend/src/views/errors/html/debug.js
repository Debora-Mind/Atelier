"use strict";
var tabLinks = new Array();
var contentDivs = new Array();
function init() {
    // Grab the tab links and content divs from the page
    var tabListItems = document.getElementById('tabs').childNodes;
    console.log(tabListItems);
    for (var i = 0; i < tabListItems.length; i++) {
        if (tabListItems[i].nodeName == "LI") {
            var tabLink = getFirstChildWithTagName(tabListItems[i], 'A');
            var id = getHash(tabLink.getAttribute('href'));
            tabLinks[id] = tabLink;
            contentDivs[id] = document.getElementById(id);
        }
    }
    // Assign onclick events to the tab links, and
    // highlight the first tab
    var i = 0;
    // @ts-ignore
    for (var id in tabLinks) {
        tabLinks[id].onclick = showTab;
        tabLinks[id].onfocus = function () {
            this.blur();
        };
        if (i == 0) {
            tabLinks[id].className = 'active';
        }
        i++;
    }
    // Hide all content divs except the first
    var i = 0;
    // @ts-ignore
    for (var id in contentDivs) {
        if (i != 0) {
            console.log(contentDivs[id]);
            contentDivs[id].className = 'content hide';
        }
        i++;
    }
}
function showTab() {
    // @ts-ignore
    var selectedId = getHash(this.getAttribute('href'));
    // Highlight the selected tab, and dim all others.
    // Also show the selected content div, and hide all others.
    for (var id in contentDivs) {
        if (id == selectedId) {
            tabLinks[id].className = 'active';
            contentDivs[id].className = 'content';
        }
        else {
            tabLinks[id].className = '';
            contentDivs[id].className = 'content hide';
        }
    }
    // Stop the browser following the link
    return false;
}
// @ts-ignore
function getFirstChildWithTagName(element, tagName) {
    for (var i = 0; i < element.childNodes.length; i++) {
        if (element.childNodes[i].nodeName == tagName) {
            return element.childNodes[i];
        }
    }
}
// @ts-ignore
function getHash(url) {
    var hashPos = url.lastIndexOf('#');
    return url.substring(hashPos + 1);
}
// @ts-ignore
function toggle(elemId) {
    var elem = document.getElementById(elemId);
    if (elem) {
        var disp;
        if (elem.style && elem.style['display']) {
            // Only works with the "style" attr
            disp = elem.style['display'];
        }
        else if (typeof window.getComputedStyle === 'function') {
            // For most other browsers
            if (document.defaultView) {
                disp = document.defaultView.getComputedStyle(elem, null).getPropertyValue('display');
            }
        }
        if (disp === 'block') {
            elem.style.display = 'none';
        }
        else {
            elem.style.display = 'block';
        }
    }
    else {
        console.error(`Element with ID "${elemId}" not found.`);
    }
    return false;
}
//# sourceMappingURL=debug.js.map