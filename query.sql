select sum(original_amount) as value, wallet_id from transaction where reason = 1 and transaction_type = 0 and
created_at >= (now() - interval '7 DAY') group by wallet_id ;