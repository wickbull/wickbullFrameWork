<?php 

	use App\Models\Controller;
	use App\Models\Page;

	class interkassa extends Controller
	{


		public static function index( $info = array() )
		{
			
			echo '<center><div style="background:#A2FFAB">It is <b>"interkassa::index()"</b> !</div></center>';

			$dataSet = $_POST;

	        if( !$dataSet )exit('ERROR! dataSet');
	        else
	        {
	            unset($dataSet['ik_sign']); //удаляем из данных строку подписи
	            ksort($dataSet, SORT_STRING); // сортируем по ключам в алфавитном порядке элементы массива
	            array_push($dataSet, '0nZ5y7bUb51mUUgp'); // добавляем в конец массива "секретный ключ"
	            $signString = implode(':', $dataSet); // конкатенируем значения через символ ":"
	            $sign = base64_encode(md5($signString, true)); // берем MD5 хэш в бинарном виде по сформированной строке и кодируем в BASE64
	            $sign; // возвращаем результат 
	        }

	        

	        if ( $sign != $_POST['ik_sign'] ) exit('ERROR! transaction');

	        // $user = DB::table('user_balance')->where('parent', $_GET['ik_pm_no'])->first();

	        // $newBalance = $user->balance + $_GET['ik_am'];

	  		$user_balance  = R::findOne( 'userbalance', ' parent = ? ', [ $_POST['ik_pm_no'] ] );

  			if( empty( $user_balance ) ) 
  			{
  				$user_bal = R::dispense('userbalance');
				$user_bal->parent = $_POST['ik_pm_no'];
				$user_bal->balance = $_POST['ik_am'];
				$user_bal->isoDateTime = R::isoDateTime();
				R::store( $user_bal );
  			}
  			elseif( !empty( $user_balance ) )
  			{ 
  				$balance = $user_balance->balance + $_POST['ik_am'];
  				$user_balance->parent = $_POST['ik_pm_no'];
				$user_balance->balance = $balance;
				$user_balance->isoDateTime = R::isoDateTime();
				R::store( $user_balance );
  			}

			

			$user_transactions = R::dispense('usertransactions');
			$user_transactions->parent = $_POST['ik_pm_no'];
			$user_transactions->balance = $_POST['ik_am'];
			$user_transactions->isoDateTime = R::isoDateTime();
			R::store( $user_transactions );

	        // DB::table('user_balance')->insert(
	        //     [
	        //         'parent' => $_POST['ik_pm_no'], 
	        //         'balance' => $_POST['ik_am'], 
	        //         'created_at' => Carbon::now(),
	        //     ]
	        // );

	        // DB::table('user_balance')
	            // ->where('parent', $_GET['ik_pm_no'])
	            // ->update(['balance' => $newBalance]);

	        // file_put_contents('logs/transaction.txt', "id: $_GET[ik_pm_no] | логін: $_GET[ik_x_login] | грн: $_GET[ik_am] <br>");
	        // file_put_contents('logs/2.txt', $_GET['ik_pm_no']);
	        // file_put_contents('logs/3.txt', $newBalance);
	        
			mkdir( $_SERVER['DOCUMENT_ROOT'] . '/logs/transactions/' . $_POST[ik_x_login] . '_' . $_POST[ik_pm_no], 0777 );

	        $f = fopen($_SERVER['DOCUMENT_ROOT'] . '/logs/transactions/' . $_POST[ik_x_login] . '_' . $_POST[ik_pm_no] . '/transaction.log', "a");
	        // fwrite($f, "id: $_POST[ik_pm_no] | логін: $_POST[ik_x_login] | грн: $_POST[ik_am] <br>");
	        fwrite($f, print_r($_POST, true)); 
	        fclose($f);

		}

	}