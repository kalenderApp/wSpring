jQuery(document).ready(function(af) {
    if (af("#commentform").length > 0) {
        var ae = af("#commentform"),
            s = "0",
            D = ae.attr("action").replace("wp-comments-post.php", ""),
            ap = D + "wp-admin/images/loading.gif",
            am = D + "wp-admin/images/no.png",
            an = '<div id="loading"><img src="' + ap + '" style="vertical-align:-2px;" alt=""/> 正在提交, 请稍候...</div>',
            ag = '<div id="error">#</div>',
            y = '">',
            B = ', 刷新页面之前可以<a rel="nofollow" class="comment-reply-link" href="#edit" onclick=\'return addComment.moveForm("',
            u = ")'>再编辑</a>",
            z = "取消编辑",
            aj, al = 0,
            ac = [],
            G = af("#comments-title"),
            q = af("#cancel-comment-reply-link"),
            p = q.text(),
            A = af("#commentform #submit");
        A.attr("disabled", false), $body = (window.opera) ? (document.compatMode == "CSS1Compat" ? af("html") : af("body")) : af("html,body");
        af("#respond").append(an + ag);
        af("#loading").hide();
        af("#error").hide();
        if (!af(".commentlist").length) {
            af("#respond").before('<ol class="commentlist"></ol>')
        }
        ae.submit(function() {
            af("#loading").slideDown();
            A.attr("disabled", true).fadeTo("slow", 0.5);
            if (aj) {
                af("#comment").after('<input type="text" name="edit_id" id="edit_id" value="' + aj + '" style="display:none;" />')
            }
            af.ajax({
                url: D,
                data: af(this).serialize() + "&action=ospring_ajax_comment",
                type: af(this).attr("method"),
                error: function(a) {
                    af("#loading").slideUp();
                    af("#error").slideDown().html('<img src="' + am + '" style="vertical-align:-2px;" alt=""/> ' + a.responseText);
                    setTimeout(function() {
                        A.attr("disabled", false).fadeTo("slow", 1);
                        af("#error").slideUp()
                    }, 3000)
                },
                success: function(b) {
                    af("#loading").hide();
                    ac.push(af("#comment").val());
                    af("textarea").each(function() {
                        this.value = ""
                    });
                    var e = addComment,
                        c = e.I("cancel-comment-reply-link"),
                        g = e.I("wp-temp-form-div"),
                        f = e.I(e.respondId),
                        a = e.I("comment_post_ID").value,
                        d = e.I("comment_parent").value;
                    if (!aj && G.length) {
                        n = parseInt(G.text().match(/\d+/));
                        G.text(G.text().replace(n, n + 1))
                    }
                    new_htm = '" id="new_comm_' + al + '"></';
                    new_htm = (d == "0") ? ("<div " + new_htm + "div>") : ('\n<ul class="children' + new_htm + "ul>");
                    ok_htm = '\n<span id="success_' + al + y;
                    if (s == "1") {
                        div_ = (document.body.innerHTML.indexOf("div-comment-") == -1) ? "" : ((document.body.innerHTML.indexOf("li-comment-") == -1) ? "div-" : "");
                        ok_htm = ok_htm.concat(B, div_, "comment-", d, '", "', d, '", "respond", "', a, '", ', al, u)
                    }
                    ok_htm += "</span><span></span>\n";
                    (d == "0") ? af(".commentlist").append(new_htm) : af("#respond").before(new_htm);
                    af("#new_comm_" + al).hide().append(b);
                    af("#new_comm_" + al + " li").append(ok_htm);
                    af("#new_comm_" + al).fadeIn(4000);
                    af("#comments-number").text(parseInt(af("#comments-number").text()) + 1);
                    $body.animate({
                        scrollTop: af("#new_comm_" + al).offset().top - 200
                    }, 900);
                    v();
                    al++;
                    aj = "";
                    af("*").remove("#edit_id");
                    c.style.display = "none";
                    c.onclick = null;
                    e.I("comment_parent").value = "0";
                    if (g && f) {
                        g.parentNode.insertBefore(f, g);
                        g.parentNode.removeChild(g)
                    }
                }
            });
            return false
        });
        addComment = {
            moveForm: function(c, d, i, b, h) {
                var a = this,
                    j, k = a.I(c),
                    f = a.I(i),
                    m = a.I("cancel-comment-reply-link"),
                    l = a.I("comment_parent"),
                    e = a.I("comment_post_ID");
                if (aj) {
                    F()
                }
                (ac.length > 0 && h) ? (a.I("comment").value = ac[h], aj = a.I("new_comm_" + h).innerHTML.match(/(comment-)(\d+)/)[2], $new_sucs = af("#success_" + h), $new_sucs.hide(), $new_comm = af("#new_comm_" + h), $new_comm.hide(), q.text(z)) : q.text(p);
                a.respondId = i;
                b = b || false;
                if (!a.I("wp-temp-form-div")) {
                    j = document.createElement("div");
                    j.id = "wp-temp-form-div";
                    j.style.display = "none";
                    f.parentNode.insertBefore(j, f)
                }

                !k ? (temp = a.I("wp-temp-form-div"), a.I("comment_parent").value = "0", temp.parentNode.insertBefore(f, temp), temp.parentNode.removeChild(temp)) : k.parentNode.insertBefore(f, k.nextSibling);

                $body.animate({
                    scrollTop: af("#respond").offset().top - 180
                }, 400);
                if (e && b) {
                    e.value = b
                }
                l.value = d;
                m.style.display = "";
                m.onclick = function() {
                    if (aj) {
                        F()
                    }
                    var I = addComment,
                        o = I.I("wp-temp-form-div"),
                        J = I.I(I.respondId);
                    I.I("comment_parent").value = "0";
                    if (o && J) {
                        o.parentNode.insertBefore(J, o);
                        o.parentNode.removeChild(o)
                    }
                    this.style.display = "none";
                    this.onclick = null;
                    return false
                };
                try {
                    a.I("comment").focus()
                } catch (g) {}
                return false
            },
            I: function(a) {
                return document.getElementById(a)
            }
        };

        function F() {
            $new_comm.show();
            $new_sucs.show();
            af("textarea").each(function() {
                this.value = ""
            });
            aj = ""
        }
        var aq = 3,
            x = A.val();

        function v() {
            if (aq > 0) {
                A.val(aq);
                aq--;
                setTimeout(v, 1000)
            } else {
                A.val(x).attr("disabled", false).fadeTo("slow", 1);
                aq = 3
            }
        }
    }
});