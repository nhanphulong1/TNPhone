# TNPhone
web backend


--Trang web được chia làm 2 phần:

*Phần cho người dùng gồm:
  +Trang chủ: giới thiệu các sản phẩm nổi bật;
  +Sản Phẩm: Chứa tất cả các sản phẩm. Có thể tìm theo nhà sản xuất hoặc tìm theo tên sản phẩm trên thanh tìm kiếm và nhấn enter.
  +Giới thiệu: Giới thiệu về công ty TNPhone.
  +Liên hệ: là nơi để khách hàng gửi những thông tin liên hệ đến chúng ta(bắt buộc điền đầy đủ thông tin).
  +Đăng ký: Nơi để khách hàng đăng ký tài khoản cá nhân với các ràng buộc phải tuân theo như
      .Tên đăng nhập phải trên 5 ký tự và không được trùng với tài khoản đã có.
      .Mật khẩu phải có độ dài từ 5-20 ký tự.
      .Nhập lại mật khẩu phải giống như mật khẩu vừa nhập ở trên.
      .Địa chỉ bắt buộc phải điền vào.
      .Email phải nhập đúng định dạng.
      .Số điện thoại phải nhập đúng định dạng với các đầu số bắt đầu bằng (09|03|07|08|05) và có độ dài là 10.
  +Đăng nhập: Nơi để khách hàng đăng nhập(Phải đăng ký trước).
  +Giỏ hàng: Là nơi khác hàng xem và cập nhật số lượng sản phẩm định mua cũng như thanh toán(Yêu cầu phải đăng nhập).
  +Chi tiết sản phẩm: Là nơi khách hàng có thể xem thông tin chi tiết về sản phẩm nào đó.
  +Đăng xuất: Ấn vào để đăng xuất khỏi tài khoản.
  
*Phần cho người quản lý trang web:
- Đầu tiên để vào được trang dành cho người quản lý cần phải đăng nhập ở trang đăng nhập với --tài khoản: admin --mật khẩu: admin.
- Sử dụng session để lưu tiến trình đăng nhập của người quản trị.
- dashboard: hiển thị các thông tin dữ liệu.
- Có các chức năng xem, thêm, sửa, xóa dữ liệu của các bảng trong csdl.
- Có chức năng tạo đơn hàng, lưu thông tin đơn, xóa và in đơn hàng.
