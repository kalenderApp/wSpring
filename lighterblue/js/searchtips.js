jQuery(document).ready(
	function(){
		// �����۽���������
		jQuery('#search .searchfield').focus(
			function() {
				// ���������������� "Type text to search here...", ������ɫ����, �������.
				if(jQuery(this).val() == 'Search') {
					jQuery(this).css({color:"#555"}).val('');
				}
			}
		// �������������ʧȥ����
		).blur(
			function(){
				// ���������������ǿ�, ��������ɫ��ǳ, ��ʾ "Type text to search here..." ����.
				if(jQuery(this).val() == '') {
					jQuery(this).css({color:"#999"}).val('Search');
				}
			}
		);
		// �����������ťʱ
		jQuery('#search .searchbutton').click(
			function() {
				// ��������������� "Type text to search here..." �����ǿ�, �������κβ���.
				if(jQuery('#search .searchfield').val() == '' || jQuery('#search .searchfield').val() == 'Search') {
					return false;
				// �����ύ����������
				} else {
					jQuery(this).submit();
				}
			}
		);
		// DOM �������ʱ�������¼�
		jQuery(
			function() {
				// ��������������� "Type text to search here..." �����ǿ�, ������ɫ��ǳ, ��ʾ "Type text to search here..." ����.
				if(jQuery('#search .searchfield').val() == '' || jQuery('#search .searchfield').val() == 'Search') {
					jQuery('#search .searchfield').css({color:"#999"}).val('Search');
				}
			}
		);
	}
)