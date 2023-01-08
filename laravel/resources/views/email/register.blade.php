{{ $user->name }} 様

このたびは会員登録いただきまして、ありがとうございます。  
どうぞ、お買い物をお楽しみください。
わたしたちも日々、楽しんでいただけるようにがんばっていきます。
今後もよろしくお願いいたします。

●発送先

お名前　{{ $user->name }}  
メール　{{ $user->email }}
電話番号　{{ $user->profile->tel }}
住所　{{ $user->profile->postcode }} {{ $prefecture }} {{ $user->profile->address }} {{ $user->profile->building }}

---
本メールにご返信いただけます。  
本メールは https://start-bootstrap.jp より送付されました。
