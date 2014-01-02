<?php echo validation_errors();?>
<?php echo form_open('user/saveuser');?>
ำรปงร๛<input type="input" name="username" value="<?php echo set_value('username')?>"/>
รÜย๋<input type="input" name="password" value="<?php echo set_value('password')?>"/>
</br>
<input type="submit" name="submit" value="login" />
</form>